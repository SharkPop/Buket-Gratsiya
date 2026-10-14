const catalogText = document.getElementById('catalog-text');
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
      e.preventDefault(); // Отменяем стандартное поведение ссылки

      let targetId = this.getAttribute('href'); // Получаем ID целевого элемента
      let targetElement = ''
      try
      {
        targetElement = document.querySelector(targetId); // Находим целевой элемент
      }
      catch(error)
      {
        console.log(error)
      }
      

      if (targetElement) {
          // Плавный скролл до целевого элемента
          targetElement.scrollIntoView({
              behavior: 'smooth', // Плавный скролл
              block: 'start' // Выравнивание элемента по верху окна
          });
      }
  });
});

document.querySelectorAll('.service-item').forEach(item => {
  let deg = 0;
  item.querySelector('.si-title').addEventListener('click', function(){
    const arrow = item.querySelector('.si-arrow');
    console.log(deg)
    arrow.style.transform = `rotate(${deg}deg)`
    if(deg == -90)
    {
      console.log("закрыто")
      deg = 0;
      item.style.maxHeight = "48px"
    }
    else if(deg == 0)
    {
      console.log("открыто")
      deg = -90;
      item.style.maxHeight = `${item.scrollHeight}px`; // Раскрытие до полной высоты содержимого
    }
  })
});
