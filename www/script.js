document.getElementById("demoForm").addEventListener("submit", function(e){
    const username = document.querySelector("[name='username']").value;
    alert("Вы ввели имя: " + username);
});
