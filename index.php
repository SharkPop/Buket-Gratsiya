<?php
include 'dbconn.php';
session_start();
if(isset($_SESSION['name']) && isset($_SESSION['surname']))
{
    $name = $_SESSION['name'];
    $surname = $_SESSION['surname'];

    $fullname = "$name $surname";
}?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Буке?Грац                                                                                                                                                                                                                   ">  
        <meta name="keywords" content="свадьба, декорации, аренда, жених, невеста"> <!-- Уже мало влияет на SEO, но иногда используется -->
        <meta name="robots" content="index, follow"> <!-- Индексировать страницу и переходить по ссылкам -->
        <meta name="author" content="Автор сайта">  
        <title>Букет&Грация</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div id="fullpage">
            <div class="header-block" id="header-block">
                <div class="header">
                    <a href="#header-block"><img src="media/bk-logo.webp"/></a>
                    <a href="#about-us">О нас</a>
                    <a href="#portfolio">Портфолио</a>
                    <a href="#services">Услуги</a>
                    <a href="#our-clients">Наши клиенты</a>
                    <a href="#contacts">Контакты</a>
                    <?php 
                        if(isset($_SESSION['name']) && isset($_SESSION['surname'])):?>
                            <a id="profileBtn" href="#"><?php echo $fullname?></a>
                            <a href="#"><img id="logoutBtn" src="media/sign-out-2.svg" width="50px" alt=""></a>
                        <?php else: ?>
                            <a id="authBtn" href="#">Войти</a>
                        <?php endif; ?>
                        <?php
                        if(isset($_SESSION['role']) && $_SESSION['role'] == 1):?>
                            <a id="adminPanel">Панель администратора</a>
                        <?php endif;?>
                </div>
            </div>
            <section class="section" id="wrap-block">
                <video autoplay muted loop id="background-video"><source src="media/wrap-banner.mp4" type="video/mp4"></video>
                <div id="wb-text">
                    <p id="wb-uppertitle">Оформление свадеб, фото и видео съемка в Перми</p>
                    <p id="wb-title">БУКЕТ & ГРАЦИЯ</p>
                </div>
            </section>
            <div class="under-wrap-block">
                <div class="uwb-title-block">
                    <p class="uwb-uppertitle">Свадебное агентство</p>
                    <p class="uwb-title">Букет&Грация</p>
                </div>
                <div class="uwb-text">
                    Мы сделаем- оформим и организуем ваш праздник так, что он останется в сердце каждого
                </div>
                <a class="wb-btn-reverse" href="tel:+79504760157">Записаться на бесплатную консультацию</a>
            </div>
            <section class="section" id="about-us">
                <div class="as-img">
                    <img src="media/lisa-10.jpg" alt="">
                </div>
                <div class="text-center as-text">
                    <p class="as-first-block">Добрый день. Меня зовут Елизавета, я основатель и руководитель студии Букет&Грация.</p>
                    <p>Наше агентство по оформлению свадеб и праздников "Букет&Грация" – это команда профессионалов, которая создаёт незабываемые свадебные моменты. Мы превращаем каждую церемонию в идеальную историю любви, объединяя искусство оформления и декора. Наши декораторы наполняют пространство изяществом, подбирая стиль и детали, которые отражают уникальность каждой пары.</p>
                    <p>Мы создаём атмосферу праздника для дня рождения, корпоративных мероприятий и конечно свадеб. Каждый элемент создаётся с душой и вниманием к мельчайшим деталям.</p>
                    <p>Агентство «Букет&Грация» занимается организацией и проведением выездной свадебной регистрацией брака. О выездной регистрации можно разговаривать часами, но лучше один раз увидеть, чем сто раз услышать. Каждая из выездных церемоний, организованных нами, не похожа друг на друга, каждая имеет собственное настроение и стиль.  С нами Вы сможете воплотить все свои идеи и мечты в реальность.</p>
                    <p>Наши фотографы ловят искренние эмоции, создавая живые воспоминания. Они умеют подчеркнуть красоту каждого момента, чтобы ваши фотографии стали настоящим сокровищем. Каждый кадр – это частичка вашей истории, наполненная чувствами и теплом.</p>
                    <p>Видеографы в свою очередь снимают атмосферные фильмы, наполненные эмоциями вашего дня. После съёмки монтажёр создаёт цельную историю, добавляя музыку и эффекты, чтобы ролик вызывал приятные эмоции и воспоминания при каждом просмотре.</p>
                </div>
            </section>
            <section class="section" id="portfolio">
                <!--<h3>Портфолио</h3>-->
                <div class="portfolio-img-block">
                    <div class="portfolio-img-item"><img src="media/Без имени-10.webp" alt="" class="portfolio-img"></div>
                    <div class="portfolio-img-item"><img src="media/Без имени-13.webp" alt="" class="portfolio-img"></div>
                    <div class="portfolio-img-item"><img src="media/Без имени-17.webp" alt="" class="portfolio-img"></div>
                    <div class="portfolio-img-item"><img src="media/Без имени-25.webp" alt="" class="portfolio-img"></div>
                </div>
                <div class="text-between-photo">
                    <p>
                        Самое главное-это ваши чувства, настроение и эмоции. А наше агентство поможет реализовать их на вашем празднике и свадьбе. Чтобы вы и все гости стали единым целом, в котором гармонично всё.
                    </p>
                </div>
                <div class="portfolio-img-block-big">
                    <img class="portfolio-img-item-big" src="media/on-stones.webp" width=1920 height=1280 alt="">
                </div>
                <div class=big-banner>
                <div class="bb-container">
                    <p class="bb-title">Наталья</p>
                    <p class="bb-upperText">Наш оформитель-декоратор и координатор</p>
                    <p class="bb-text">Наталья оформитель-декоратор и координатор-человек который позаботится о всех вопросах оформления, проконтролирует все детали и сделает все необходимые звонки.</p>
                    <p>Будет на связи 24 часа в сутки и ответит на все возникающие вопросы.</p>
                </div>
                </div>
                <div class="video-container">
                    <video src=""></video>
                </div>
                <div>
                    <h3>Отзывы</h3>
                    <div class="reviews-block">
                        <?php 
                            $sqlFb = "SELECT * FROM `feedback` ORDER BY `id` DESC LIMIT 8";
                            $stmtFb = $conn->prepare($sqlFb);
                            $stmtFb->execute();
                            $feedbackResult = $stmtFb->get_result();
                            $feedbacks = $feedbackResult->fetch_all(MYSQLI_ASSOC);

                            foreach($feedbacks as $feedback):?>
                                <?php 
                                    $sqlO = "SELECT * FROM `order` WHERE `id` = ?";
                                    $stmtO = $conn->prepare($sqlO);
                                    $stmtO->bind_param('i',$feedback['orderID']);
                                    $stmtO->execute();
                                    $orderRes = $stmtO->get_result();
                                    $order = $orderRes->fetch_assoc();
                                    
                                    $sqlU = "SELECT * FROM `user` WHERE `id` = ?";
                                    $stmtU = $conn->prepare($sqlU);
                                    $stmtU->bind_param('i',$order['UserID']);
                                    $stmtU->execute();
                                    $userResult = $stmtU->get_result();
                                    $user = $userResult->fetch_assoc();
                                ?>
                                <div class="review">
                                    <p class="review-name"><?= $user['Name']?> <?= $user['Surname']?></p>
                                    <p class="review-text"><?= $feedback['text'] ?></p>
                                </div>       
                            <?php endforeach;?>

                        <!--<div class="review">
                            <p class="review-name">Игорь Смирнов</p>
                            <p class="review-text">Отличная команда! Учли все пожелания, помогли с выбором стиля. Результат превзошел ожидания.</p>
                        </div>
                        <div class="review">
                            <p class="review-name">Марина Коваль</p>
                            <p class="review-text">Все гости были в восторге от оформления! Стильно, нежно и очень атмосферно. Спасибо за волшебство!</p>
                        </div>
                        <div class="review">
                            <p class="review-name">Александр Власов</p>
                            <p class="review-text">Профессионалы своего дела! Оформление сделано со вкусом, все детали продуманы до мелочей.</p>
                        </div>
                        <div class="review">
                            <p class="review-name">Ольга Васильева</p>
                            <p class="review-text">Было очень приятно работать с вами! Быстро, качественно и с душой. Всем рекомендую!</p>
                        </div>
                        <div class="review">
                            <p class="review-name">Дмитрий Соколов</p>
                            <p class="review-text">Организация на высшем уровне! Красота в каждой детали, даже не ожидал такого результата!</p>
                        </div>
                        <div class="review">
                            <p class="review-name">Екатерина Литвинова</p>
                            <p class="review-text">Просто сказка! Все идеально вписалось в нашу концепцию. Огромное спасибо за вашу работу!</p>
                        </div>
                        <div class="review">
                            <p class="review-name">Владимир Никифоров</p>
                            <p class="review-text">Обратился за оформлением корпоратива, и это было лучшее решение! Всё выглядело шикарно.</p>
                        </div>-->
                    </div>
                </div>
            </section>
            <div class="call-to-us">
                <div class="ctu-div">
                    <p>Ваше счастье выше цены</p>
                    <a class="wb-btn" href="tel:+79504760157">Позвонить</a>
                </div>
            </div>
            <section class="section" id="services">
                <!--<h3>Наши услуги</h3>-->
                <div class="service-list">
                    <div class="service-item">
                        <div class="si-title">
                            <img src="media/arrow.png" alt="" class="si-arrow">
                            <img src="media/Church.png" alt="" class="si-img">
                            <p class="si-title-text">Место проведения</p>
                        </div>
                        <div class="si-content">
                            <p>
                                *текст временный*<br><br>
                            🌟 <b>Ваша мечта о незабываемой свадьбе или мероприятии начинается здесь!</b> 🌟  
                            <br><br>
                            Планирование праздника — это не просто подготовка, это создание истории, которую вы будете вспоминать с теплом и улыбкой. Но давайте честно: поиск идеального места может быть утомительным, сложным и даже стрессовым.  
                            <br><br>
                            ✨ <b>Почему стоит доверить это нам?</b> ✨  
                            - 🎯 <b>Индивидуальный подход</b>: Мы знаем, что каждый праздник уникален, и подберем место, которое идеально отразит ваш стиль и желания.  
                            - 💼 <b>Опыт и экспертиза</b>: Наша команда уже помогла сотням пар и организаторов найти площадки мечты — от уютных кафе до роскошных залов.  
                            - ⏳ <b>Экономия времени</b>: Забудьте о бесконечных поисках и звонках. Мы сделаем всё за вас, предложив лучшие варианты.  
                            - 💰 <b>Выгодные условия</b>: Благодаря нашим партнерствам, вы получите доступ к эксклюзивным предложениям и скидкам.  
                            <br><br>
                            🎉 <b>Позвольте нам сделать ваш праздник идеальным!</b> 🎉  
                            Позвоните нам прямо сейчас, и мы подберем для вас место, которое станет идеальным фоном для вашего счастья.  
                            <br><br>
                            💌 <b>Ваша сказка начинается здесь — доверьте её нам!</b> 💌
                            </p>
                        </div>
                    </div>
                    <div class="service-item">
                        <div class="si-title">
                            <img src="media/arrow.png" alt="" class="si-arrow">
                            <img src="media/Photo.png" alt="" class="si-img">
                            <p class="si-title-text">Фото и видео</p>
                        </div>
                        <div class="si-content">
                            *тут будет прайс-лист*
                        </div>  
                    </div>
                    <div class="service-item">
                        <div class="si-title">
                            <img src="media/arrow.png" alt="" class="si-arrow">
                            <img src="media/Microphone.png" alt="" class="si-img">
                            <p class="si-title-text">Ведущий</p>
                        </div>
                        <div class="si-content">
                        💫 Ведущие, которые превратят вашу свадьбу в волшебство! ✨

    Представьте: идеальный день, наполненный смехом 😊, нежными моментами 🥰 и искренними эмоциями 💞. Наши ведущие — это не просто аниматоры, а настоящие волшебники праздника, которые:

    🎭 Поймут вашу уникальность с полуслова 🤫💬

    💃🕺 Создадут атмосферу, где каждому гостю будет тепло и весело

    😌 Мягко направят праздник, чтобы вы могли просто наслаждаться своим днём

    ✨ Превратят обычные моменты в трогательные воспоминания

    Хотите:

    Романтичную церемонию со слезами счастья? 💐😢💖

    Душевный банкет с тёплыми тостами? 🥂🍾

    Или зажигательную вечеринку до утра? 🎉🕺💃

    Мы найдём идеального ведущего, который почувствует ваш стиль и сделает праздник по-настоящему вашим!

    📩 Расскажите нам о вашей паре — и мы создадим день, который вы будете вспоминать с улыбкой даже через годы! 💌💘
                        </div>
                    </div>
                    <div class="service-item">
                        <div class="si-title">
                            <img src="media/arrow.png" alt="" class="si-arrow">
                            <img src="media/Wedding Arch.png" alt="" class="si-img">
                            <p class="si-title-text">Декорация и флористика</p>
                        </div>
                        <div class="si-content">
                            <div class="si-c-products-block">
                            <form method="post" action="createOrder.php" id="weddingCalculator">
                                <h2>Калькулятор стоимости свадьбы</h2>
                                <!-- Выбор стола -->
                                <div class="">
                                    <p>Тип стола:</p>
                                    <div class="tableList">
                                        <?php
                                        $sql = "SELECT * FROM `services` WHERE ServiceTypeID = ?";
                                        $stmt = $conn->prepare($sql);
                                        $serviceTypeID = 1;
                                        $stmt->bind_param('i', $serviceTypeID);
                                        $stmt->execute();
                                        $services = $stmt->get_result();
                                        foreach($services as $service): ?>
                                            <label class="serviceField table" style="cursor: pointer;">
                                                <input type="radio" class="table" name="table" value="<?= $service['id'] ?>" style="display:none;">
                                                <img width="128" height="128" src="media/images/<?=$service['Image']?>" alt="Изображение">
                                                <p><?= $service['Name'] ?></p>
                                                <p>Цена: <?= $service['Price'] ?> руб</p>
                                            </label>
                                        <?php endforeach;
                                        ?>
                                    </div>
                                </div>
                                
                                <!-- Выбор арки -->
                                <div class="">
                                    <p>Тип арки:</p>
                                    <div class="archList">
                                        <?php
                                        $sql = "SELECT * FROM `services` WHERE ServiceTypeID = ?";
                                        $stmt = $conn->prepare($sql);
                                        $serviceTypeID = 2;
                                        $stmt->bind_param('i', $serviceTypeID);
                                        $stmt->execute();
                                        $services = $stmt->get_result();
                                        foreach($services as $service): ?>
                                        <label class="serviceField arch" style="cursor: pointer;">
                                            <input type="radio" class="arch" name="arch" value="<?= $service['id'] ?>" style="display:none;">
                                            <img src="<?= $service['Image'] ?>" alt="Изображение">
                                            <p><?= $service['Name'] ?></p>
                                            <p>Цена: <?= $service['Price'] ?> руб</p>
                                        </label>
                                        <?php endforeach;
                                        ?>
                                    </div>
                                </div>
                                
                                <!-- Дополнительные опции -->
                                <?php 
                                // Подключение к базе и выборка
                                $sql = "SELECT * FROM `services` WHERE ServiceTypeID = ?";
                                $stmt = $conn->prepare($sql);
                                $serviceTypeID = 3;
                                $stmt->bind_param('i', $serviceTypeID);
                                $stmt->execute();
                                $services = $stmt->get_result(); ?>
                                <div class="additionalOptions">
                                    <p>Дополнительные услуги</p>
                                    <div class="additionalOptionsRows">
                                        <?php foreach($services as $service): ?>
                                            <div class="AOItem">
                                                <input type="checkbox" class="other" name="other[]" value="<?= $service['id'] ?>">
                                                <p><?= $service['Name'] ?></p>
                                                <p>Цена: <?= $service['Price'] ?> руб</p>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <?php
                                $sql = "SELECT * FROM `colors`";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                $colors = $stmt->get_result(); ?>
                                <p>Цвета свадьбы</p>
                                <div class="colorsList">
                                    
                                    <?php foreach($colors as $color): ?>
                                        <?php if($color['Name'] == "Свой") :?>
                                            <label style="cursor: pointer;">
                                                <input type="radio" class="color" name="color" value="<?= $color['id'] ?>" style="display:none;">
                                                <p><?= $color['Name']?></p>
                                            </label>
                                        <?php else: ?>
                                            <label style="cursor: pointer;">
                                                <input type="radio" class="color" name="color" value="<?= $color['id'] ?>" style="display:none;">
                                                <img src="media/images/<?= $color['Image']?>" width="32" height="32" alt="">
                                            </label>
                                        <?php endif; ?>
                                    <?php endforeach;?>
                                </div>
                                <p>Кол-во людей</p>
                                <input id="amount" name="amount" type="number" style="width: 50px;">                   
                                <button type="submit" class="wb-btn-reverse" id="createOrderBtn">Оформить заказ</button>
                            </form>
                            </div>
                        </div>
                    </div>
                    <div class="service-item">
                        <div class="si-title">
                            <img src="media/arrow.png" alt="" class="si-arrow">
                            <img src="media/To Do.png" alt="" class="si-img">
                            <p class="si-title-text">Свадебный организатор</p>
                        </div>
                        <div class="si-content"></div>
                    </div>
                    <div class="service-item">
                        <div class="si-title">
                            <img src="media/arrow.png" alt="" class="si-arrow">
                            <img src="media/Wedding Ring.png" alt="" class="si-img">
                            <p class="si-title-text">Выездная организация</p>
                        </div>
                        <div class="si-content"></div>
                    </div>
                </div>
            </section>
            <section class="section" id="our-clients">
                <!--<h3>Наши клиенты</h3>-->
                <div>

                </div>
            </section>
            <section class="section" id="contacts">
                <div class="contacts-container">
                    <!--<h1 class="contacts-title">Контакты</h1>-->

                    <p class="contacts-description">
                        Мы работаем без выходных с 8:00 до 21:00.<br>
                        Свяжитесь с нами, чтобы записаться на бесплатную консультацию и организовать свадьбу своей мечты
                    </p>
                    <div class="ci-sm-block">
                        <div class="contact-info">
                            <div class="city-name">Пермь:</div>
                            <div class="address">Петропавловская 93</div>
                            <div class="phone">Телефон: <a href="tel:+79504760157">+7-950-4760-157</a></div>
                            <div class="email">E-mail: <a href="mailto:n-nerova@mail.ru">n-nerova@mail.ru</a></div>
                        </div>
                        <div class="social-media">
                            <p class="social-media-title">Соц. сети</p>
                            <div class="social-media-list">
                                <a href="https://vk.com/foto_video19_perm" class="social-icon">
                                    <img width="25" height="25" src="https://bg59.online/We/photos/vk-png.webp" alt="VK">
                                    <p>ВКонтакте</p>
                                </a>

                                <a href="" class="social-icon">
                                    <img width="25" height="25" src="https://bg59.online/We/photos/tg-png.webp" alt="Telegram">
                                    <p>Telegram</p>
                                </a>
                                <a href="https://wa.me/89504760157" class="social-icon">
                                    <img width="25" height="25" src="https://bg59.online/We/photos/wa-png.webp" alt="WhatsApp">
                                    <p>WhatsApp</p>
                                </a>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="section" id="footer">
                <div class="brand-section">
                    <div class="brand-title">
                        <div class="brand-name">Букет&Грация</div>
                        <div class="brand-slogan">Ваше счастье выше цены</div>
                    </div>
                </div>
                <div class="nav-columns">
                    <div class="nav-group">
                        <a href="#fullpage" class="nav-link">Главная</a>
                        <a href="#about-us" class="nav-link">О нас</a>
                        <a href="#portfolio" class="nav-link">Портфолио</a>
                    </div>
                    <div class="nav-group">
                        <a href="#services" class="nav-link">Услуги</a>
                        <a href="#our-clients" class="nav-link">Наши клиенты</a>
                    </div>
                    <div class="nav-group">
                        <a href="#contacts" class="nav-link">Контакты</a>
                    </div>
                </div>
                <div class="social-section">
                    <div class="social-links">
                        <a href="" class="social-icon">
                            <img src="https://bg59.online/We/photos/vk-png.webp" alt="VK">
                        </a>
                        <a href="" class="social-icon">
                            <img src="https://bg59.online/We/photos/tg-png.webp" alt="Telegram">
                        </a>
                        <a href="" class="social-icon">
                            <img src="https://bg59.online/We/photos/wa-png.webp" alt="WhatsApp">
                        </a>
                    </div>
                </div>
                <div class="footer-contacts">
                    <div class="fc-background">
                        <div class="fc-item">
                            <img width="25" height="25" src="https://bg59.online/We/photos/for site webp/adress-white.webp" alt="">
                            <p>г. Пермь ул. Петропавловская 93</p>
                        </div>
                        <div class="fc-item">
                            <img width="25" height="25" src="https://bg59.online/We/photos/for site webp/phone-white.webp" alt="">
                            <p>+7 (950) 476-01-57</p>
                        </div>
                        <div class="fc-item">
                            <img width="30" height="25" src="https://bg59.online/We/photos/for site webp/mail-white.webp" alt="">
                            <p>n-nerova@mail.ru</p>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <span>© 2025 Букет&Грация. Все права защищены</span>
                </div>
            </div>
        </div>
        <script src="script.js"></script>
        <script src="ajax.js"></script>
        <script src="calcScript.js"></script>
    </body>
    </html>