document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("weddingCalculator");
    // Цены на элементы
    fetch('getPrices.php',{
        method: 'POST'
    })
    .then(response => response.json())
    .then(data=>{
        if(data.status == 'success')
        {
            // Блок для отображения итоговой стоимости
            const totalPriceElement = document.createElement("div");
            totalPriceElement.id = "totalPrice";
            totalPriceElement.style.marginTop = "20px";
            totalPriceElement.style.fontWeight = "bold";
            form.appendChild(totalPriceElement);
            const prices = data.services;
            function calculateTotal() {
                let total = 0;
                console.log(prices)
                let selectedArch;
                let selectedTable;
            
                let tableList = form.querySelectorAll('.table');
                let archList = form.querySelectorAll('.arch');
                let otherList = form.querySelectorAll('.other');
                let count = form.querySelector("#amount");
                count.addEventListener("input", calculateTotal);
                
                tableList.forEach(element => {
                    if(element.checked)
                    {
                        selectedTable = element;
                    }
                });
                archList.forEach(element => {
                    if(element.checked)
                    {
                        selectedArch = element;
                    }
                });
                // Стол
                if (selectedArch != null) {
                    let id = selectedArch.value;
                    total += prices[id-1].Price || 0;
                    console.log(id);
                }
                // Арка
                if (selectedTable != null) {
                    let id = selectedTable.value;
                    total += prices[id-1].Price * Math.ceil(Number(count.value) / 4) || 0;
                    console.log(id);
                }
                otherList.forEach(element => {
                    if(element.checked)
                    {
                        total += prices[element.value -1].Price;
                    }
                });
                totalPriceElement.textContent = "Итоговая стоимость: " + total.toLocaleString() + " ₽";
            }
        
            // Слушатели событий
            form.addEventListener("change", calculateTotal);
        
            // Инициализация
            calculateTotal();
        }
    })
});