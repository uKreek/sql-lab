document.getElementById("demoForm").addEventListener("submit", function(e){
    const name = document.querySelector("[name='name']").value;
    alert("Вы ввели имя: " + name);
});
