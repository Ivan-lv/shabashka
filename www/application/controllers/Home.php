<?php
/**
 * Created by PhpStorm.
 * User: DNS
 * Date: 14.11.15
 * Time: 0:04
 */

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('categories','cat',TRUE);
        $this->load->model('users','users',TRUE);
        $this->load->model('adverts','adverts',TRUE);
        $this->load->helper('url');

    }

    public function index() {

        $this->load->helper('html');


        $this->load->view('common/header');

        $message['title'] = 'Добро пожаловать на портал объявлений ШАБАШКА!';
        $message['description'] = 'Здесь заказчик может найти для себя мастера а мастер работу! Портал содержит большое колличество категорий работы которые
            легко найти с помощью поиска. Соискатели могут создавать свои личные карточки которые будут интересны работодателем. Трудитесь на здоровье !!! ';
        $this->load->view('common/messageBlock', $message);

        $categs = $this->cat->getCategories();
//        foreach($categs as $categ){
//            $subcats = $this->cat->getSubCategories($categ['id']);
//            $categ['subcats'] = $subcats;
//        }

        for($i = 0; $i < count($categs); $i++) {
            $subcats = $this->cat->getSubCategories($categs[$i]['id']);
            $categs[$i]['subcats'] = $subcats;
        }
//        $s = $this->cat->getSubCategories(3);
//                    echo "<pre>" . print_r($categs) . "</pre>";


        $data['categs'] = $categs;

        $data['masters'] = $this->users->getTheBestUserMaster(10, 'DESC');
        $adverts = $this->adverts->getLastAdverts();
        $data['adverts'] = $adverts;

        $this->load->view('homepageContent', $data); // $data here!

        $this->load->view('common/footer');

    }



    private function generateTestCategories() {
        $categs = array(
            array(
                'id' => 1,
                'name' => 'Сантехнические работы',
                'imgName' => 'cat1.jpg',
                'subcats' => array(
                    array(
                        'id' => 1,
                        'name' => 'замена труб водопровода/канализации'
                    ),
                    array(
                        'id' => 2,
                        'name' => 'замена стояков, батарей и радиаторов'
                    ),
                    array(
                        'id' => 3,
                        'name' => 'ремонт и установка сантехники'
                    ),
                    array(
                        'id' => 4,
                        'name' => 'установка счетчиков'
                    ),
                    array(
                        'id' => 5,
                        'name' => 'устранение засоров, прочистка канализаций'
                    )

                )
            ),
            array(
                'id' => 2,
                'name' => 'Электромонтажные работы',
                'imgName' => 'cat2.jpg',
                'subcats' => array(
                    array(
                        'id' => 7,
                        'name' => 'подключение электроприборов'
                    ),
                    array(
                        'id' => 8,
                        'name' => 'подключение люстр, бра и т.д'
                    ),
                    array(
                        'id' => 9,
                        'name' => 'экстренные выезды «нет света»'
                    ),
                    array(
                        'id' => 6,
                        'name' => 'замена электропроводки'
                    ),
                    array(
                        'id' => 6,
                        'name' => 'частичная замена проводки, перенос розеток и выключателей'
                    )

                )
            ),
            array(
                'id' => 3,
                'name' => 'Ремонт бытововой техники',
                'imgName' => 'cat3.jpg',
                'subcats' => array(
                    array(
                        'id' => 11,
                        'name' => 'ремонт домашних бытовых приборов (телевизор, пылесос, холодильник и т.п.)'
                    ),
                    array(
                        'id' => 12,
                        'name' => 'ремонт компьютеров и переферийных устройств'
                    ),
                    array(
                        'id' => 13,
                        'name' => 'ремонт телефонов'
                    )

                )
            ),
            array(
                'id' => 4,
                'name' => 'Плотницкие работы',
                'subcats' => array(
                    array(
                        'id' => 14,
                        'name' => 'установка дверей'
                    ),
                    array(
                        'id' => 15,
                        'name' => 'монтаж полов, паркета, ламината'
                    ),
                    array(
                        'id' => 16,
                        'name' => 'установка и ремонт окон'
                    ),
                    array(
                        'id' => 17,
                        'name' => 'установка/сборка мебели'
                    )

                )
            ),
            array(
                'id' => 5,
                'name' => 'Отделочные работы',
                'subcats' => array(
                    array(
                        'id' => 18,
                        'name' => 'составление смет'
                    ),
                    array(
                        'id' => 19,
                        'name' => 'натяжные потолки'
                    ),
                    array(
                        'id' => 20,
                        'name' => 'штукатурные работы'
                    ),
                    array(
                        'id' => 21,
                        'name' => 'евроотделка'
                    )

                )
            ),
            array(
                'id' => 6,
                'name' => 'Уборка помещений, территорий',
                'subcats' => array(
                    array(
                        'id' => 22,
                        'name' => 'уборка квартир'
                    ),
                    array(
                        'id' => 23,
                        'name' => 'уборка офисов'
                    ),
                    array(
                        'id' => 24,
                        'name' => 'уборка территорий'
                    )

                )
            ),
            array(
                'id' => 7,
                'name' => 'Уход и присмотр',
                'subcats' => array(
                    array(
                        'id' => 25,
                        'name' => 'уход за домашними животными'
                    ),
                    array(
                        'id' => 26,
                        'name' => 'работа няни'
                    ),
                    array(
                        'id' => 27,
                        'name' => 'присмотр за пожилыми'
                    )

                )
            ),
            array(
                'id' => 8,
                'name' => 'Кухонные работы',
                'subcats' => array(
                    array(
                        'id' => 28,
                        'name' => 'приготовление пищи'
                    ),
                    array(
                        'id' => 29,
                        'name' => 'поставка продуктов'
                    ),
                    array(
                        'id' => 30,
                        'name' => 'мытье посуды'
                    )

                )
            ),
            array(
                'id' => 9,
                'name' => 'Разное',
                'subcats' => array(

                )
            )
        );
    }
}