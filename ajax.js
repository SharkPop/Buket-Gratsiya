const authBtn = document.getElementById('authBtn');
const logoutBtn = document.getElementById('logoutBtn');
const profileBtn = document.getElementById('profileBtn');
const adminPanelBtn = document.getElementById('adminPanel');
const form = document.getElementById('weddingCalculator');
if(logoutBtn)
    {
        //Выход из аккаунта
        logoutBtn.addEventListener('click', function(){
            let formData = new FormData();
    
            fetch('logout.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.status == "success")
                    {
                        console.log(data)
                        location.reload(true);
                    }            
            });
        })
    }
if(profileBtn){
    profileBtn.addEventListener('click', function(){
        // Затемнение фона
        let shadowBody = document.createElement('div');
        shadowBody.classList.add('shadowBody');
        document.body.appendChild(shadowBody);

        // Окно авторизации
        let profileWindowBody = document.createElement('div');
        profileWindowBody.classList.add('authWindowBody');

        //Контейнер для меню
        let innerDiv = document.createElement('div');
        innerDiv.classList.add('dffdcg')
        showProfile(innerDiv)

        // Кнопка закрытия
        let closeButton = document.createElement('span');
        closeButton.textContent = '✖';
        closeButton.classList.add('closeBtn');
        closeButton.addEventListener('click', () => {
            document.body.removeChild(shadowBody);
            document.body.style.overflow = '';
        });
        
        profileWindowBody.appendChild(closeButton);
        profileWindowBody.appendChild(innerDiv);
        shadowBody.append(profileWindowBody);
    
        document.body.appendChild(shadowBody);
    
        // Запрет прокрутки
        document.body.style.overflow = 'hidden';
    })
}
if(authBtn){
    authBtn.addEventListener('click', function () {
        // Затемнение фона
        let shadowBody = document.createElement('div');
        shadowBody.classList.add('shadowBody');
        document.body.appendChild(shadowBody);
    
        // Окно авторизации
        let authWindowBody = document.createElement('div');
        authWindowBody.classList.add('authWindowBody');
    
        //Контейнер для меню
        let innerDiv = document.createElement('div');
        innerDiv.classList.add('dffdcg')
    
        // Кнопка закрытия
        let closeButton = document.createElement('span');
        closeButton.textContent = '✖';
        closeButton.classList.add('closeBtn');
        closeButton.addEventListener('click', () => {
            document.body.removeChild(shadowBody);
            document.body.removeChild(authWindowBody);
            document.body.style.overflow = '';
        });
    
        showAuthInputs(innerDiv);
    
        authWindowBody.appendChild(closeButton);
        authWindowBody.appendChild(innerDiv);
        shadowBody.append(authWindowBody);
    
        document.body.appendChild(authWindowBody);
    
        // Запрет прокрутки
        document.body.style.overflow = 'hidden';
    });
}
if(adminPanelBtn){
    adminPanelBtn.addEventListener('click', function(){
        // Затемнение фона
        let shadowBody = document.createElement('div');
        shadowBody.classList.add('shadowBody');
        document.body.appendChild(shadowBody);

        // Окно панели администратора
        let apWindow = document.createElement('div');
        apWindow.classList.add('authWindowBody');

        //Общая форма сортировки/фильтрации
        let formBlock = document.createElement('form')
        formBlock.method = "POST"
        formBlock.action = "getAllOrders.php"

        // Поле сортировки
        let sortDiv = document.createElement('div');
        sortDiv.className = 'sortDiv';

        let sortP = document.createElement('p');
        sortP.className = 'sortP';
        sortP.textContent = 'Сортировка по: ';

        let sortSelect = document.createElement('select');
        sortSelect.className = 'sortSelect';
        sortSelect.name = 'sortField';

        let sortDirBtn = document.createElement('select');
        sortDirBtn.className = 'sortSelect';
        sortDirBtn.name = 'sortDirection';

        // Добавляем опции корректно
        let dirOpt1 = document.createElement('option');
        dirOpt1.value = 'asc';
        dirOpt1.textContent = 'По возрастанию';

        let dirOpt2 = document.createElement('option');
        dirOpt2.value = 'desc';
        dirOpt2.textContent = 'По убыванию';

        sortDirBtn.appendChild(dirOpt1);
        sortDirBtn.appendChild(dirOpt2);

        // Добавляем опции корректно
        let option1 = document.createElement('option');
        option1.value = 'OrderDate';
        option1.textContent = 'По дате';

        let option2 = document.createElement('option');
        option2.value = 'id';
        option2.textContent = 'По ID';

        sortSelect.appendChild(option1);
        sortSelect.appendChild(option2);

        sortDiv.appendChild(sortP);
        sortDiv.appendChild(sortSelect);
        sortDiv.appendChild(sortDirBtn);

        //Создание верхней панели
        let filterPanelDiv = document.createElement('div');

        //Фильтрация по id
        let filterByIDDiv = document.createElement('div');
        filterByIDDiv.style.display = "flex";
        filterByIDDiv.style.flexDirection = "column";
        filterByIDDiv.style.gap = "5px";

        let filterByIDP = document.createElement('p')
        filterByIDP.textContent = "Поиск по id";

        let filterByIDInput = document.createElement('input');
        filterByIDInput.name = "idSearch"

        filterByIDDiv.appendChild(filterByIDP);
        filterByIDDiv.appendChild(filterByIDInput);

        //Фильтрация по дате
        let filterByDateDiv = document.createElement('div');
        filterByDateDiv.style.display = "flex";
        filterByDateDiv.style.flexDirection = "column";
        filterByDateDiv.style.gap = "5px";

        let filterByDateP = document.createElement('p');
        filterByDateP.textContent = "Поиск по дате"

        let fbddRow = document.createElement('div')
        fbddRow.style.display = "flex";
        fbddRow.style.flexDirection = "row";
        fbddRow.style.gap = "5px";

        let fbdifP = document.createElement('p');
        fbdifP.textContent = "С";

        let filterByDateInputFrom = document.createElement('input');
        filterByDateInputFrom.type = 'date';
        filterByDateInputFrom.name = 'dateFrom'

        let fbditP = document.createElement('p');
        fbditP.textContent = "по";

        let filterByDateInputTo = document.createElement('input');
        filterByDateInputTo.type = 'date';
        filterByDateInputTo.name = 'dateTo'

        fbddRow.appendChild(fbdifP);
        fbddRow.appendChild(filterByDateInputFrom);
        fbddRow.appendChild(fbditP);
        fbddRow.appendChild(filterByDateInputTo);

        filterByDateDiv.appendChild(filterByDateP);
        filterByDateDiv.appendChild(fbddRow);

        filterPanelDiv.appendChild(filterByIDDiv);
        filterPanelDiv.appendChild(filterByDateDiv);

        formBlock.appendChild(filterPanelDiv);
        formBlock.appendChild(sortDiv);

        //Контейнер для меню
        let innerDiv = document.createElement('div');
        innerDiv.classList.add('dffdcg');

        // Вешаем обработчик на каждый элемент формы
        [...formBlock.elements].forEach(el => {
        if (el.tagName.toLowerCase() === 'input' && (el.type === 'text' || el.type === 'search' || el.type === 'date' || el.type === 'number')) {
            // Для текстовых, числовых, дат — событие input (срабатывает при каждом изменении текста)
            el.addEventListener('input', () => {
                const fd = new FormData(formBlock);
                sortByParams(innerDiv, fd);
            });
        } else {
            // Для остальных (select, checkbox и т.п.) — оставить change
            el.addEventListener('change', () => {
                const fd = new FormData(formBlock);
                sortByParams(innerDiv, fd);
            });
        }
});


        showAdminPanel(innerDiv);
        // Кнопка закрытия
        let closeButton = document.createElement('span');
        closeButton.textContent = '✖';
        closeButton.classList.add('closeBtn');
        closeButton.addEventListener('click', () => {
            document.body.removeChild(shadowBody);
            document.body.style.overflow = '';
        });
    
    apWindow.appendChild(closeButton);
    apWindow.appendChild(formBlock);
    apWindow.appendChild(innerDiv);
    shadowBody.append(apWindow);

    document.body.appendChild(shadowBody);

    // Запрет прокрутки
    document.body.style.overflow = 'hidden';
    })
}
form.addEventListener('submit', function(event) {
    event.preventDefault(); // Отменяем стандартное поведение формы
    // Создаем FormData из формы
    const formData = new FormData(form);
    console.log(formData);
    // Отправляем данные на сервер через fetch
    fetch(form.action, {
        method: form.method,
        body: formData
    })
    .then(response => {
        return response.json();
    })
    .then(data => {
        console.log('Ответ сервера:', data);
        if (data.status === 'success') {
            alert('Заказ успешно оформлен! ID заказа: ' + data.order_id);
            console.log(data.post)
        } else {
            alert('Ошибка: ' + data.message);
        }
    })
    .catch(err => {
        console.error('Ошибка запроса:', err);
        alert('Произошла ошибка при оформлении заказа.');
    });
});
function showAuthInputs(innerDiv)
{
    // Текст сверху блока
    let textP = document.createElement('p');
    textP.classList.add('textP');
    textP.textContent = 'Авторизация';
    textP.style.textAlign = "center";

    // Email input, div и p
    let authEmailText = document.createElement('p')
    authEmailText.textContent = "Email";

    let authEmailInput = document.createElement('input');
    authEmailInput.setAttribute('type', 'email');
    authEmailInput.classList.add('authEmailInput');

    let authEmailDiv = document.createElement('div');
    authEmailDiv.style.display = "flex";
    authEmailDiv.style.gap = "5px";
    authEmailDiv.style.flexDirection = "column"

    authEmailDiv.appendChild(authEmailText);
    authEmailDiv.appendChild(authEmailInput);

    // Password input, div и p
    let authPasswordText = document.createElement('p')
    authPasswordText.textContent = "Пароль";

    let authPasswordInput = document.createElement('input');
    authPasswordInput.setAttribute('type', 'password');
    authPasswordInput.classList.add('authPasswordInput');

    let authPasswordDiv = document.createElement('div');
    authPasswordDiv.style.display = "flex";
    authPasswordDiv.style.gap = "5px";
    authPasswordDiv.style.flexDirection = "column"

    authPasswordDiv.appendChild(authPasswordText);
    authPasswordDiv.appendChild(authPasswordInput);

    // Кнопка регистрации
    let regBtn = document.createElement('a');
    regBtn.textContent = "Зарегистрироваться";
    regBtn.classList.add('regBtn');
    regBtn.classList.add('wb-btn-reverse');
    regBtn.addEventListener('click', function(){
        innerDiv.textContent = '';
        showRegInputs(innerDiv);
    })

    // Кнопка входа
    let authLogInBtn = document.createElement('button');
    authLogInBtn.setAttribute('id', 'loginBtn');
    authLogInBtn.textContent = "Войти";
    authLogInBtn.classList.add('wb-btn-reverse');
    authLogInBtn.addEventListener('click', function () {
        const email = authEmailInput.value.trim();
        const password = authPasswordInput.value.trim();

        if (!email || !password) {
            alert("Заполните оба поля!");
            return;
        }
        let formData = new FormData();
        formData.append('email', email);
        formData.append('password', password);
        

        fetch('auth.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if(data.status == "success")
                {
                    location.reload(true);
                }
            else if(data.status == "wrongEmail" || data.status == "wrongPass")
                {
                    alert("Неверный логин или пароль!")
                }            
        });

    });

    // Добавляем элементы в окно
    innerDiv.appendChild(textP);
    innerDiv.appendChild(authEmailDiv);
    innerDiv.appendChild(authPasswordDiv);
    innerDiv.appendChild(authLogInBtn);
    innerDiv.appendChild(regBtn);
}
function showRegInputs(innerDiv){
    // Текст сверху блока
    let textP = document.createElement('p');
    textP.classList.add('textP');
    textP.textContent = 'Регистрация';
    textP.style.textAlign = "center";

    // Поле полного имени, div и p
    let fullNameP = document.createElement('p')
    fullNameP.textContent = "Полное имя (ФИО)";

    let fullNameDiv = document.createElement('div')
    fullNameDiv.style.display = "flex";
    fullNameDiv.style.gap = "10px";

    let fullNameOutterDiv = document.createElement('div');
    fullNameOutterDiv.style.display = "flex";
    fullNameOutterDiv.style.gap = "5px";
    fullNameOutterDiv.style.flexDirection = "column"

    fullNameOutterDiv.appendChild(fullNameP);
    fullNameOutterDiv.appendChild(fullNameDiv);

    let nameInput = document.createElement('input');
    let surnameInput = document.createElement('input');
    let patronymicInput = document.createElement('input');

    fullNameDiv.appendChild(nameInput);
    fullNameDiv.appendChild(surnameInput);
    fullNameDiv.appendChild(patronymicInput);

    // Поле ввода номера телефона, div и p
    let phoneNumberP = document.createElement('p')
    phoneNumberP.textContent = "Номер телефона";

    let phoneNumberInput = document.createElement('input');

    let phoneNumberDiv = document.createElement('div');
    phoneNumberDiv.style.display = "flex";
    phoneNumberDiv.style.gap = "5px";
    phoneNumberDiv.style.flexDirection = "column"

    phoneNumberDiv.appendChild(phoneNumberP)
    phoneNumberDiv.appendChild(phoneNumberInput)

    // Email input, div и p
    let authEmailP = document.createElement('p')
    authEmailP.textContent = "Email";

    let authEmailInput = document.createElement('input');
    authEmailInput.setAttribute('type', 'email');
    authEmailInput.classList.add('authEmailInput');

    let authEmailDiv = document.createElement('div');
    authEmailDiv.style.display = "flex";
    authEmailDiv.style.gap = "5px";
    authEmailDiv.style.flexDirection = "column"

    authEmailDiv.appendChild(authEmailP);
    authEmailDiv.appendChild(authEmailInput);

    // Password input, div и p
    let authPasswordP = document.createElement('p')
    authPasswordP.textContent = "Пароль";

    let authPasswordInput = document.createElement('input');
    authPasswordInput.setAttribute('type', 'password');
    authPasswordInput.classList.add('authPasswordInput');

    let authPasswordDiv = document.createElement('div');
    authPasswordDiv.style.display = "flex";
    authPasswordDiv.style.gap = "5px";
    authPasswordDiv.style.flexDirection = "column"

    authPasswordDiv.appendChild(authPasswordP);
    authPasswordDiv.appendChild(authPasswordInput);

    // Кнопка авторизации
    let authBtn = document.createElement('button');
    authBtn.setAttribute('id', 'authBtn');
    authBtn.textContent = "Есть аккаунт? Войти";
    authBtn.classList.add('wb-btn-reverse');
    authBtn.addEventListener('click', function(){
        innerDiv.textContent = '';
        showAuthInputs(innerDiv);
    })

    let approvalDiv = document.createElement('div');
    approvalDiv.style.display        = 'flex';
    approvalDiv.style.alignItems     = 'center';
    approvalDiv.style.justifyContent = 'flex-start';
    approvalDiv.style.gap            = '10px';

    let approvalCheckbox = document.createElement('input');
    approvalCheckbox.type = 'checkbox';
    approvalCheckbox.id   = 'approvalCheckbox';
    // отменяем глобальную ширину
    approvalCheckbox.style.flex  = '0 0 auto';
    approvalCheckbox.style.width = 'auto';

    let approvalLabel = document.createElement('label');
    approvalLabel.htmlFor   = 'approvalCheckbox';
    approvalLabel.textContent = 'Подтверждая, вы соглашаетесь на обработку персональных данных';
    // тоже по размеру контента
    approvalLabel.style.flex = '0 0 auto';

    approvalDiv.append(approvalCheckbox, approvalLabel);
    
document.querySelector('.authWindowBody').appendChild(approvalDiv);


    // Кнопка регистрации
    let regBtn = document.createElement('button');
    regBtn.setAttribute('id', 'regBtn');
    regBtn.textContent = "Зарегистрироваться";
    regBtn.classList.add('wb-btn-reverse');
    regBtn.addEventListener('click', function () {
        const email = authEmailInput.value.trim();
        const password = authPasswordInput.value.trim();
        const name = nameInput.value.trim();
        const surname = surnameInput.value.trim();
        const patronymic = patronymicInput.value.trim();
        const phonenum = phoneNumberInput.value.trim();

        if (!email || !password || !name || !surname || !patronymic || !phonenum) {
            alert("Заполните все поля!");
            console.log("проблема на стороне js")
            return;
        }
        if(!approvalCheckbox)
        {
            alert("Подтвердите обработку персональных данных!")
            return;
        }

        let formData = new FormData();
        formData.append('email', email);
        formData.append('password', password);
        formData.append('name', name);
        formData.append('surname', surname);
        formData.append('patronymic', patronymic);
        formData.append('phonenum', phonenum);
        formData.append('approval', approvalCheckbox.checked ? 'yes' : '')

        fetch('reg.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if(data.status == "success")
                {
                    location.reload(true);
                }
            else if(data.status == "error")
                {
                    alert(data.message);
                    console.log(data)
                    return;
                }
            else if(data.status == "nocheck")
                {
                    alert(data.message);
                    console.log(data)
                    return;
                }          
        });

    });

    innerDiv.appendChild(textP);
    innerDiv.appendChild(fullNameOutterDiv);
    innerDiv.appendChild(phoneNumberDiv);
    innerDiv.appendChild(authEmailDiv);
    innerDiv.appendChild(authPasswordDiv);
    innerDiv.appendChild(approvalDiv);
    innerDiv.appendChild(regBtn);
    innerDiv.appendChild(authBtn);
}
function showProfileData(contentDiv){
    contentDiv.innerHTML = '';
    let name = '';
    let surname = '';
    let patronymic = '';
    let phonenum = '';
    let email = '';

    fetch('getUser.php', {
        method: 'POST'
    })
    .then(response => response.json())
    .then(data => {
        if(data.status == "success")
        {
            name = data.userData.name;
            surname = data.userData.surname;
            patronymic = data.userData.patronymic;
            phonenum = data.userData.phonenum;
            email = data.userData.email;

            let profileDatDiv = document.createElement('div');
            profileDatDiv.classList.add('profileDatDiv');

            let fullNameDiv = document.createElement('div');
            fullNameDiv.classList.add('FullNameDiv');

            let fullNameLabel = document.createElement('p');
            fullNameLabel.textContent = 'ФИО';

            let innerFNDiv = document.createElement('div');
            innerFNDiv.classList.add('innerFNDiv');

            let nameInput = document.createElement('input');
            nameInput.type = 'text';
            nameInput.id = 'NameInput';
            nameInput.value = name;

            let surnameInput = document.createElement('input');
            surnameInput.type = 'text';
            surnameInput.id = 'SurnameInput';
            surnameInput.value = surname;

            let patronymicInput = document.createElement('input');
            patronymicInput.type = 'text';
            patronymicInput.id = 'PatronymicInput';
            patronymicInput.value = patronymic;

            innerFNDiv.appendChild(nameInput);
            innerFNDiv.appendChild(surnameInput);
            innerFNDiv.appendChild(patronymicInput);
            fullNameDiv.appendChild(fullNameLabel);
            fullNameDiv.appendChild(innerFNDiv);

            let saveBtnDiv = document.createElement('div');
            saveBtnDiv.classList.add('saveBtnDiv');

            // Создаем кнопку
            let saveBtn = document.createElement('button');
            saveBtn.id = 'saveBtn';
            saveBtn.textContent = 'Сохранить';
            saveBtn.classList.add('wb-btn-reverse')
            saveBtn.addEventListener('click', function(){
                let formData = new FormData();
                formData.append('name',nameInput.value);
                formData.append('surname', surnameInput.value);
                formData.append('patronymic', patronymicInput.value);
                formData.append('phonenum', phoneNumberInput.value);
                fetch('saveProfileData.php',{
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data =>{
                    if(data.status == 'success')
                    {
                        alert(data.message);
                        location.reload(true);
                    }
                    else if(data.status == 'error')
                    {
                        alert(data.message);
                    }
                })
            })
            
            // Добавляем кнопку в div
            saveBtnDiv.appendChild(saveBtn);

            let phoneNumberDiv = document.createElement('div');
            phoneNumberDiv.classList.add('PhoneNumberDiv');

            let phoneNumberLabel = document.createElement('p');
            phoneNumberLabel.textContent = 'Номер телефона';

            let phoneNumberInput = document.createElement('input');
            phoneNumberInput.type = 'number';
            phoneNumberInput.id = 'PhoneNumberInput';
            phoneNumberInput.value = phonenum;

            phoneNumberDiv.appendChild(phoneNumberLabel);
            phoneNumberDiv.appendChild(phoneNumberInput);

            let emailDiv = document.createElement('div');
            emailDiv.classList.add('EmailDiv');

            let emailLabel = document.createElement('p');
            emailLabel.textContent = 'Почта';

            let emailInput = document.createElement('input');
            emailInput.type = 'text';
            emailInput.id = 'EmailInput';
            emailInput.value = email;
            emailInput.disabled = 'true'

            emailDiv.appendChild(emailLabel);
            emailDiv.appendChild(emailInput);

            profileDatDiv.appendChild(fullNameDiv);
            profileDatDiv.appendChild(phoneNumberDiv);
            profileDatDiv.appendChild(saveBtnDiv);
            profileDatDiv.appendChild(emailDiv);

            contentDiv.appendChild(profileDatDiv);
        }
        else if(data.status == "error")
        {
            console.log(data)
        }        
    });

    
}
function showOrderHistory(contentDiv, formBlock,orderListDiv){
    contentDiv.innerHTML = '';
    orderListDiv.innerHTML = '';
    contentDiv.appendChild(formBlock)
    let orders = [];

    fetch('getOrders.php',{
        method: 'POST'
    })
    .then(response => response.json())
    .then(data =>{
        if(data.status == 'success')
        {
            orders = data.orders;
            orders.forEach(order => {
                const orderDiv = document.createElement("div");
                orderDiv.className = "orderDiv";
            
                const codeP = document.createElement("p");
                codeP.textContent = `Код: ${order.id}`;
            
                const dateP = document.createElement("p");
                const options = { day: 'numeric', month: 'long', year: 'numeric' };
                let date = new Date(order.OrderDate);
                const formatted = date.toLocaleDateString('ru-RU', options);
                dateP.textContent = `Дата: ${formatted}`;
            
                const detailsBtn = document.createElement("button");
                detailsBtn.id = 'detailsBtn';
                detailsBtn.classList.add('wb-btn-reverse');
                detailsBtn.textContent = "Подробности";
                detailsBtn.addEventListener('click', function(){
                    showDetails(contentDiv,formatted,order.id,false);
                })
            
                orderDiv.appendChild(codeP);
                orderDiv.appendChild(dateP);
                orderDiv.appendChild(detailsBtn);
            
                orderListDiv.appendChild(orderDiv); 
            });
        }
        else if(data.status == 'null')
        {
            let nullOrdersText = document.createElement('p');
            nullOrdersText.className = 'nullOrdersText';
            nullOrdersText.textContent = 'У вас нет заказов!';

            orderListDiv.appendChild(nullOrdersText);
        }
    })
    contentDiv.appendChild(orderListDiv)
}
function showProfile(innerDiv){
    let profileDiv = document.createElement('div');
    profileDiv.classList.add('profileDiv');

    let selectDiv = document.createElement('div');
    selectDiv.classList.add('selectDiv');
    
    let contentDiv = document.createElement('div');
    contentDiv.classList.add('contentDiv');
    showProfileData(contentDiv);

    let profileBtn = document.createElement('button');
    profileBtn.textContent = 'Профиль';
    profileBtn.classList.add('profileFunctionBtn')
    profileBtn.classList.add('wb-btn-reverse')
    profileBtn.style.width = '100%'
    profileBtn.addEventListener('click', function(){
        showProfileData(contentDiv);
    })

    //Общая форма сортировки/фильтрации
        let formBlock = document.createElement('form')
        formBlock.method = "POST"
        formBlock.action = "getAllOrders.php"

        // Поле сортировки
        let sortDiv = document.createElement('div');
        sortDiv.className = 'sortDiv';

        let sortP = document.createElement('p');
        sortP.className = 'sortP';
        sortP.textContent = 'Сортировка по: ';

        let sortSelect = document.createElement('select');
        sortSelect.className = 'sortSelect';
        sortSelect.name = 'sortField';

        let sortDirBtn = document.createElement('select');
        sortDirBtn.className = 'sortSelect';
        sortDirBtn.name = 'sortDirection';

        // Добавляем опции корректно
        let dirOpt1 = document.createElement('option');
        dirOpt1.value = 'asc';
        dirOpt1.textContent = 'По возрастанию';

        let dirOpt2 = document.createElement('option');
        dirOpt2.value = 'desc';
        dirOpt2.textContent = 'По убыванию';

        sortDirBtn.appendChild(dirOpt1);
        sortDirBtn.appendChild(dirOpt2);

        // Добавляем опции корректно
        let option1 = document.createElement('option');
        option1.value = 'OrderDate';
        option1.textContent = 'По дате';

        let option2 = document.createElement('option');
        option2.value = 'id';
        option2.textContent = 'По ID';

        sortSelect.appendChild(option1);
        sortSelect.appendChild(option2);

        sortDiv.appendChild(sortP);
        sortDiv.appendChild(sortSelect);
        sortDiv.appendChild(sortDirBtn);

        //Создание верхней панели
        let filterPanelDiv = document.createElement('div');

        //Фильтрация по id
        let filterByIDDiv = document.createElement('div');
        filterByIDDiv.style.display = "flex";
        filterByIDDiv.style.flexDirection = "column";
        filterByIDDiv.style.gap = "5px";

        let filterByIDP = document.createElement('p')
        filterByIDP.textContent = "Поиск по id";

        let filterByIDInput = document.createElement('input');
        filterByIDInput.name = "idSearch"

        filterByIDDiv.appendChild(filterByIDP);
        filterByIDDiv.appendChild(filterByIDInput);

        //Фильтрация по дате
        let filterByDateDiv = document.createElement('div');
        filterByDateDiv.style.display = "flex";
        filterByDateDiv.style.flexDirection = "column";
        filterByDateDiv.style.gap = "5px";

        let filterByDateP = document.createElement('p');
        filterByDateP.textContent = "Поиск по дате"

        let fbddRow = document.createElement('div')
        fbddRow.style.display = "flex";
        fbddRow.style.flexDirection = "row";
        fbddRow.style.gap = "5px";

        let fbdifP = document.createElement('p');
        fbdifP.textContent = "С";

        let filterByDateInputFrom = document.createElement('input');
        filterByDateInputFrom.type = 'date';
        filterByDateInputFrom.name = 'dateFrom'

        let fbditP = document.createElement('p');
        fbditP.textContent = "по";

        let filterByDateInputTo = document.createElement('input');
        filterByDateInputTo.type = 'date';
        filterByDateInputTo.name = 'dateTo'

        fbddRow.appendChild(fbdifP);
        fbddRow.appendChild(filterByDateInputFrom);
        fbddRow.appendChild(fbditP);
        fbddRow.appendChild(filterByDateInputTo);

        filterByDateDiv.appendChild(filterByDateP);
        filterByDateDiv.appendChild(fbddRow);

        filterPanelDiv.appendChild(filterByIDDiv);
        filterPanelDiv.appendChild(filterByDateDiv);

        formBlock.appendChild(filterPanelDiv);
        formBlock.appendChild(sortDiv);

        const orderListDiv = document.createElement("div");
        orderListDiv.className = "orderListDiv";

        // Вешаем обработчик на каждый элемент формы
        [...formBlock.elements].forEach(el => {
        if (el.tagName.toLowerCase() === 'input' && (el.type === 'text' || el.type === 'search' || el.type === 'date' || el.type === 'number')) {
            // Для текстовых, числовых, дат — событие input (срабатывает при каждом изменении текста)
            el.addEventListener('input', () => {
                const fd = new FormData(formBlock);
                sortByParams(orderListDiv, fd);
            });
        } else {
            // Для остальных (select, checkbox и т.п.) — оставить change
            el.addEventListener('change', () => {
                const fd = new FormData(formBlock);
                sortByParams(orderListDiv, fd);
            });
        }
});


    
    let ordersBtn = document.createElement('button');
    ordersBtn.textContent = 'История заказов';
    ordersBtn.classList.add('profileFunctionBtn')
    ordersBtn.classList.add('wb-btn-reverse')
    ordersBtn.style.width = '100%'
    ordersBtn.addEventListener('click', function(){
        showOrderHistory(contentDiv, formBlock,orderListDiv)
    })

    selectDiv.appendChild(profileBtn);
    selectDiv.appendChild(ordersBtn);

    profileDiv.appendChild(selectDiv);
    profileDiv.appendChild(contentDiv);
    innerDiv.appendChild(profileDiv)
}
function showDetails(contentDiv, date, orderID,admin)
{
    let formData = new FormData();
    formData.append('id',orderID);
    fetch('getDetails.php',{
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data =>{
        if(data.status == 'success')
        {
            contentDiv.innerHTML = '';
            const orderDetailsDiv = document.createElement("div");
            orderDetailsDiv.className = "orderDetailsDiv";

            // Код
            const pId = document.createElement("p");
            pId.className = "ODid";
            pId.textContent = `Код: ${orderID}`;

            // Дата
            const pDate = document.createElement("p");
            pDate.className = "ODdate";
            pDate.textContent = `Дата: ${date}`;
            // Состав заказа
            const pServices = document.createElement("p");
            pServices.className = "ODservices";
            pServices.style.whiteSpace = "pre-line";
            
            let text = '';
            let priceP = document.createElement('div');
            priceP.textContent = `${data.order.Price} руб.`
            let price = 0;

            data.details.forEach(detail => {
                let serviceID = new FormData();
                
                serviceID.append('serviceID',detail.ServiceID);
                fetch('getService.php',{
                    method: 'POST',
                    body: serviceID
                })
                .then(response => response.json())
                .then(data =>{
                    if(data.status == 'success')
                    {
                        console.log(price)
                        text += `${data.service.Name}\n`;
                        pServices.textContent = `Состав заказа:\n\n${text}`;
                    }
                })
            });
            // Блок с изображением
            const imagesDiv = document.createElement("div");
            imagesDiv.className = "ODimagesDiv";
            imageArray = [];

            let imageFD = new FormData();
            imageFD.append('orderID', orderID)
            fetch('getImages.php',{
                method: 'POST',
                body: imageFD
            })
            .then(response => response.json())
            .then(data =>{
                if(data.status == 'success')
                {
                    imageArray = data.images
                    // Создание модального контейнера (один раз)
                    const modal = document.createElement("div");
                    modal.style.position = "fixed";
                    modal.style.top = 0;
                    modal.style.left = 0;
                    modal.style.width = "100%";
                    modal.style.height = "100%";
                    modal.style.backgroundColor = "rgba(0, 0, 0, 0.8)";
                    modal.style.display = "none";
                    modal.style.justifyContent = "center";
                    modal.style.alignItems = "center";
                    modal.style.zIndex = "9999";

                    // Вставка изображения
                    const fullImg = document.createElement("img");
                    fullImg.style.maxWidth = "90%";
                    fullImg.style.maxHeight = "90%";
                    fullImg.style.boxShadow = "0 0 20px white";
                    modal.appendChild(fullImg);

                    // Закрытие при клике вне изображения
                    modal.addEventListener("click", () => {
                        modal.style.display = "none";
                    });

                    // Добавление модального окна в документ
                    document.body.appendChild(modal);

                    // Отображение изображений из массива
                    data.images.forEach(image => {
                        const img = document.createElement("img");
                        img.className = "IDimage";
                        img.src = `media/images/${image.Name}`;
                        img.alt = "";
                        img.style.cursor = "pointer";

                        // Открытие модального окна при клике
                        img.addEventListener("click", () => {
                            fullImg.src = img.src;
                            modal.style.display = "flex";
                            document.body.appendChild(modal);
                        });

                        imagesDiv.appendChild(img);
                    });
                    // Кнопка на скачивание файлов
                    let downloadBtn = document.createElement('a');
                    downloadBtn.textContent = "Скачать";
                    downloadBtn.className = 'downloadBtn'
                    downloadBtn.addEventListener('click', function(){
                        const filesToZip = imageArray; // [{id: 1, Name: 'file1.jpg'}, ...]
                        const formData = new FormData();

                        filesToZip.forEach(file => formData.append('files[]', file.Name)); // отправляем только имена файлов

                        fetch('downloadZip.php', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.blob())
                        .then(blob => {
                            const url = window.URL.createObjectURL(blob);
                            const a = document.createElement('a');
                            a.href = url;
                            a.download = 'photos.zip';
                            document.body.appendChild(a);
                            a.click();
                            a.remove();
                            window.URL.revokeObjectURL(url);
                        });
                    })
                    orderDetailsDiv.appendChild(downloadBtn);
                }
                else if(data.status == 'error')
                {
                    console.log(data.message);
                    console.log(data.details);
                }
                
            })
            //  Блок редактирования фотографий к заказу (доступ есть только у администратора)
            // Контейнер, куда вставим форму
            const container = document.createElement('div');
            container.id = 'uploadContainer';
            document.body.appendChild(container);
            if(data.role == 1 && admin == true)
            {
                // Создаём форму
                const form = document.createElement('form');
                form.id = 'uploadForm';
                form.enctype = 'multipart/form-data';

                // Заголовок
                const label = document.createElement('label');
                label.textContent = 'Загрузите фото:';

                // Поле выбора файлов
                const input = document.createElement('input');
                input.type = 'file';
                input.name = 'images[]';
                input.accept = 'image/*';
                input.multiple = true;
                input.required = true;

                // Кнопка отправки
                const button = document.createElement('button');
                button.type = 'submit';
                button.textContent = 'Загрузить';

                // Контейнер для статуса
                const statusDiv = document.createElement('div');
                statusDiv.id = 'uploadStatus';

                // Добавляем элементы в форму
                form.appendChild(label);
                form.appendChild(document.createElement('br'));
                form.appendChild(input);
                form.appendChild(button);

                // Добавляем форму и статус в контейнер
                container.appendChild(form);
                container.appendChild(statusDiv);
                // Обработчик отправки
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    const formData = new FormData(form);
                    formData.append('orderID', orderID)
                    fetch('addPhotos.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {
                        console.log(data)
                        if (data.status === 'success') {
                            statusDiv.innerHTML = '<p style="color:green">Файлы успешно загружены!</p>';
                            showDetails(contentDiv, date, orderID,true)
                        } else {
                            statusDiv.innerHTML = `<p style="color:red">Ошибка: ${data.message}</p>`;
                        }
                    })
                    .catch(err => {
                        statusDiv.innerHTML = `<p style="color:red">Ошибка: ${err.message}</p>`;
                    });
                });

            }
            
            // Собираем всё
            orderDetailsDiv.appendChild(pId);
            orderDetailsDiv.appendChild(pDate);
            orderDetailsDiv.appendChild(pServices);
            orderDetailsDiv.appendChild(priceP)
            orderDetailsDiv.appendChild(imagesDiv);
            orderDetailsDiv.appendChild(container);

// Область комментария
            if(data.feedback === 'null')
            {
                let feedbackDiv = document.createElement('div');
                feedbackDiv.classList.add('dffdc');
                feedbackDiv.style.gap = "20px"

                let feedbackH = document.createElement('p')
                feedbackH.textContent = "Отзыв:";

                let feedbackInput = document.createElement('textarea');

                let feedbackSend = document.createElement('button');
                feedbackSend.textContent = "Отправить отзыв"
                feedbackSend.classList.add('regBtn')
                feedbackSend.classList.add('wb-btn-reverse');

                feedbackDiv.appendChild(feedbackH);
                feedbackDiv.appendChild(feedbackInput);
                feedbackDiv.appendChild(feedbackSend);
                feedbackSend.addEventListener('click', function() {
                    let formData = new FormData();
                    formData.append('feedbackText', feedbackInput.value);
                    formData.append('orderID', orderID)
                    fetch('createFeedback.php',{
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data =>{
                        if(data.status == "success")
                        {
                            alert('Отзыв оставлен!\nСпасибо за ваше мнение!');
                            location.reload(true);
                        }
                        else if(data.status == 'error')
                        {
                            alert('Ошибка!' + data.message)
                        }
                    })
                })
                orderDetailsDiv.appendChild(feedbackDiv)
            }
            else
            {
                let feedbackP = document.createElement('p');
                feedbackP.textContent = data.feedback.text;
                orderDetailsDiv.appendChild(feedbackP);
                console.log('Отзыв:' + data.feedback.text);
            }

            contentDiv.appendChild(orderDetailsDiv);
        }
        else if(data.status == 'null')
        {
            console.log(data);
            return;
        }
        else if(data.status == 'error')
        {
            console.log(data.message);
            return;
        }
    })
}
function showAdminPanel(innerDiv){
    let orders = [];
    fetch('getAllOrders.php',{
        method: 'POST'
    })
    .then(response => response.json())
    .then(data =>{
        if(data.status == 'success')
        {
            innerDiv.innerHTML = ''
            console.log(data.orders)
            orders = data.orders;
            orders.forEach(order => {
                const orderDiv = document.createElement("div");
                orderDiv.className = "orderDiv";
            
                const codeP = document.createElement("p");
                codeP.textContent = `Код: ${order.id}`;
            
                const dateP = document.createElement("p");
                const options = { day: 'numeric', month: 'long', year: 'numeric' };
                let date = new Date(order.OrderDate);
                const formatted = date.toLocaleDateString('ru-RU', options);
                dateP.textContent = `Дата: ${formatted}`;
            
                const detailsBtn = document.createElement("button");
                detailsBtn.id = 'detailsBtn';
                detailsBtn.classList.add('wb-btn-reverse');
                detailsBtn.textContent = "Подробности";
                detailsBtn.addEventListener('click', function(){
                    showDetails(innerDiv,formatted,order.id,true);
                })
            
                orderDiv.appendChild(codeP);
                orderDiv.appendChild(dateP);
                orderDiv.appendChild(detailsBtn);
            
                innerDiv.appendChild(orderDiv); 
            });
        }
        else if(data.status == 'null')
        {
            let nullOrdersText = document.createElement('p');
            nullOrdersText.className = 'nullOrdersText';
            nullOrdersText.textContent = 'У вас нет заказов!';
            
            innerDiv.appendChild(nullOrdersText);
        }
    })
}
function sortByParams(innerDiv, formData)
{
    innerDiv.innerHTML = '';

    fetch('getAllOrders.php',{
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data =>{
        if(data.status == 'success')
        {
            orders = data.orders;
            orders.forEach(order => {
                const orderDiv = document.createElement("div");
                orderDiv.className = "orderDiv";
            
                const codeP = document.createElement("p");
                codeP.textContent = `Код: ${order.id}`;
            
                const dateP = document.createElement("p");
                const options = { day: 'numeric', month: 'long', year: 'numeric' };
                let date = new Date(order.OrderDate);
                const formatted = date.toLocaleDateString('ru-RU', options);
                dateP.textContent = `Дата: ${formatted}`;
            
                const detailsBtn = document.createElement("button");
                detailsBtn.id = 'detailsBtn';
                detailsBtn.classList.add('wb-btn-reverse');
                detailsBtn.textContent = "Подробности";
                detailsBtn.addEventListener('click', function(){
                    showDetails(innerDiv,formatted,order.id, true);
                })
            
                orderDiv.appendChild(codeP);
                orderDiv.appendChild(dateP);
                orderDiv.appendChild(detailsBtn);
            
                innerDiv.appendChild(orderDiv);
            });
        }
    })
}