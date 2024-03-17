
//döljer/visar menyn för blogg
blogglink = document.getElementById('blogglink');

if (blogglink) {
    blogglink.onclick = function(){
        var all = document.getElementById("alllink");
        var create = document.getElementById("createlink");
        var del = document.getElementById("deletelink");
        
        if (create.style.display === "block") {
            all.style.display = "none";
            create.style.display = "none";

            del.style.display = "none";
        } else {
            all.style.display = "block";
            create.style.display = "block";
            del.style.display = "block";
        }
        return false;
    };
};

//döljer/visar listan för användare

userlistbtn = document.getElementById('userlistbtn');

userlistbtn.onclick = function(){
    var userlist = userlistbtn.parentElement.parentElement.getElementsByClassName("submenu");
    for (let i = 0; i < userlist.length; i++) {
        if (userlist[i].style.display === "block") {
            userlist[i].style.display = "none";
        } else {
            userlist[i].style.display = "block";
        }
    }
    return false;
};

let createbtn = document.getElementById('createbtn');

if (createbtn) {
    createbtn.onclick = function(){
        var form = document.getElementById("CreateForm");
            
        if (form.style.display === "block") {
            form.style.display = "none";
        }
        return false;
    };
}


let hamburgermenu = document.getElementById('hamburgermenu');
hamburgermenu.onclick = function(){
    let sidebar = document.getElementById("sidebar");
    if (sidebar.className === "sidebar") {
        sidebar.className = 'sidebar open';
    } else {
        sidebar.className = 'sidebar';
    }
};


var tableSelect = document.getElementsByClassName("table-select");
for (let i = 0; i < tableSelect.length; i++) {

    let checkbox = tableSelect[i].getElementsByClassName('checkbox')[0];

    checkbox.addEventListener('change', (event) => {
        if (event.currentTarget.checked) {
            tableSelect[i].className = 'table-select selected';
        } else {
            tableSelect[i].className = 'table-select';
        }
      })

    tableSelect[i].onclick = function(ev){
        if (ev.srcElement.nodeName == 'INPUT') {
            return;
        }
        if (checkbox.checked)
        {
            tableSelect[i].className = 'table-select';
            checkbox.checked = false;
        } else {
            tableSelect[i].className = 'table-select selected';
            checkbox.checked = true;
        }
    };
}

