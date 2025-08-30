<footer class="py-8">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row space-x-2">
            <div class="w-full md:w-1/4">
                <h3 class="text-xl font-bold mb-4 text-red-700 ">ВремяПобед.рус</h3>
                <p class="text-gray-400">Последние спортивные новости и&nbsp;события из&nbsp;мира спорта. Всегда только
                    свежая
                    информация.</p>
            </div>
            <div class="w-full md:w-1/4">
                @if(1==2)
                                <h4 class="font-bold mb-4">Разделы</h4>
                                <ul class="space-y-2">
                                    <li><a href="#" class="text-gray-400 hover:text-primary">Футбол</a></li>
                                    <li><a href="#" class="text-gray-400 hover:text-primary">Хоккей</a></li>
                                    <li><a href="#" class="text-gray-400 hover:text-primary">Баскетбол</a></li>
                                    <li><a href="#" class="text-gray-400 hover:text-primary">Теннис</a></li>
                                </ul>
                @endif
            </div>
            <div class="w-full md:w-1/4">
                @if(1==2)
                                <h4 class="font-bold mb-4">О нас</h4>
                                <ul class="space-y-2">
                                    <li><a href="#" class="text-gray-400 hover:text-primary">Контакты</a></li>
                                    <li><a href="#" class="text-gray-400 hover:text-primary">Реклама</a></li>
                                    <li><a href="#" class="text-gray-400 hover:text-primary">Вакансии</a></li>
                                    <li><a href="#" class="text-gray-400 hover:text-primary">Партнеры</a></li>
                                </ul>
                    @endif
            </div>
            <div class="w-full md:w-1/4">
                @if(1==2)
                                <h4 class="font-bold mb-4">Подписка</h4>
                                <p class="text-gray-400 mb-4">Подпишитесь на наши новости</p>
                                <div class="flex">
                                    <input type="email" placeholder="Ваш email" class="px-3 py-2 rounded-l text-dark w-full">
                                    <button class="bg-primary hover:bg-red-800 px-4 py-2 rounded-r">
                                        <i class="fas fa-paper-plane"></i>
                                    </button>
                                </div>
                                <div class="flex space-x-4 mt-4">
                                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-vk text-xl"></i></a>
                                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-telegram text-xl"></i></a>
                                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-youtube text-xl"></i></a>
                                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter text-xl"></i></a>
                                </div>
                    @endif
            </div>
        </div>

    </div>

    <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-400">
        <p>©{{ date('Y') }} Все права защищены.
            &nbsp; &nbsp; &nbsp;
            Создание сайта: <a href="https://php-cat.com"
                               class="text-blue-600 hover:underline"
                               target="_blank">php-cat.com</a></p>
    </div>


    @if(1==2)
        <div class="py-3 bg-gray-200">
            <footer class="mx-auto container ">
                <div class="flex flex-col space-y-3  ">
                    <div class="flex flex-col space-y-3 sm:space-y-0 sm:flex-row">
                        <div class="w-full sm:w-1/2 text-center">
                            v1.1.1 &copy; Все права защищены {{ date('Y') }}
                            {{--                    <br/>--}}
                            {{--                    Тех поддержка: <a--}}
                            {{--                        class="text-blue-700 hover:underline"--}}
                            {{--                        href="mailto:support@php-cat.com">support@php-cat.com</a>--}}
                        </div>
                        <div class="w-full sm:w-1/2 text-center">Создание сервиса <a href="https://php-cat.com"
                                                                                     class="text-blue-600 hover:underline"
                                                                                     target="_blank">php-cat.com</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    @endif
</footer>