console.log(Date());
let ser = document.getElementById('serch');
let showall = document.getElementById('showall');
let tb = document.getElementById('tb');
ser.addEventListener('keyup', function () {
    fetch(`http://localhost/disc/admin/comp/select_user.php?email='${ser.value}'`).then(function (data) {
        return data.text();
    }).then(function (txt) {
        tb.innerHTML=txt;
    })
});
// tb.innerHTML = "<h1>hello";

showall.addEventListener('click', function () {
    fetch('http://localhost/disc/admin/comp/select_all_user.php').then(function (data) {
        return data.text();
    }).then(function (txt) {
        tb.innerHTML = txt;
        console.log(txt)
        console.log("hello world")
    })
});