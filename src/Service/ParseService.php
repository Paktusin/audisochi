<?php
/**
 * Created by PhpStorm.
 * User: paktus-lnx
 * Date: 01.05.18
 * Time: 15:14
 */

namespace App\Service;

use App\Entity\Car;
use App\Entity\Part;
use App\Service;
use Sunra\PhpSimple\HtmlDomParser;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ParseService extends Service
{
    private $url = 'http://audi-rus.ru';

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
    }

    public function parseAudi()
    {
        $html = HtmlDomParser::str_get_html(file_get_contents($this->url));
        foreach ($html->find('a[name="tuning"]')[0]->next_sibling()->find('a') as $car_html_a) {
            $title = $car_html_a->children(0)->innertext();
            if (mb_strpos($title, 'Audi') !== false) {
                $car = $this->container->get(CarService::class)->findOrCreate('Audi',
                    trim(str_replace(' -', '', str_replace('Тюнинг Audi ', '', $title)))
                );
                $this->parseTypes($car_html_a->href, $car);
            }
        }
    }

    /**
     * @param string $url
     * @param Car $car
     */
    private function parseTypes($url, $car)
    {
        $html = HtmlDomParser::str_get_html(file_get_contents($this->url . $url));
        foreach ($html->find('ul.ca-menu2 a') as $html_type_a) {
            $title = $html_type_a->children(0)->innertext();
            $type = $this->container->get(PartTypeService::class)->findOrCreate(
                trim(str_replace($car->getModel(), '', $title)),
                5
            );
            $this->parseParts($html_type_a->href, $type, $car);
        }
    }

    /**
     * @param string $url
     * @param Car $car
     */
    private function parseParts($url, $type, $car)
    {
        $html = HtmlDomParser::str_get_html(file_get_contents($this->url . $url));
        foreach ($html->find('.productslist .product .goods-list-title a') as $html_a) {
            $name = $html_a->innertext();
            $part = $this->container->get('doctrine')->getRepository(Part::class)
                ->findOneBy(['name' => $name, 'type' => $type, 'car' => $car]);
            if (!$part) {
                $html_part = HtmlDomParser::str_get_html(file_get_contents($this->url . $html_a->href));
                if ($html_part) {
                    $part = new Part();
                    $part->setName($name);
                    $part->setCar($car);
                    $part->setType($type);
                    $html_price_arr = $html_part->find('.product-price');
                    if (!empty($html_price_arr)) {
                        $price = $html_price_arr[0]->innertext();
                    }
                    $price = str_replace(' руб.', '', $price);
                    $part->setPrice(floatval($price));
                    $html_desc_arr = $html_part->find('.product-description dd');
                    if (!empty($html_desc_arr)) {
                        $desc = $html_desc_arr[0]->innertext();
                        $part->setDescription($desc);
                    }
                    $this->em->persist($part);
                    $this->em->flush();
                }
            }
        }
    }
}