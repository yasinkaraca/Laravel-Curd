

function goback(location){
    console.log(location);
    //window.location.href = window.location.hostname + location + "/" + no;
    //console.log(window.location.href + " " + window.location.hostname);
    window.location.href = location;
    console.log(window.location.href + " " + window.location.hostname);
    //window.alert(window.location.href + " " + location);
}
function showList(page, column, ascending, find){
    var mTable = document.getElementById("studentList");
    var headerRow = mTable.rows[0].cells;

    switch(window.column){
        case "no": headerRow[0].innerHTML = "Student Number"; break;
        case "name": headerRow[1].innerHTML = "Name"; break;
        case "surname": headerRow[2].innerHTML = "Surname"; break;
        case "department": headerRow[3].innerHTML = "Department"; break;
    }
    
    if(page != window.page) 
        window.page = page;
    else if(column != window.column || ascending != window.ascending){
        
        if(column != window.column){
            window.column = column;
            window.ascending = ascending = true;
        }
        else if(ascending != window.ascending)
            window.ascending = ascending;
        
        if(find)
            sortList(findList);
            
        else
            sortList(window.students);
            
    }

    if(find != window.find){
        window.find = find;

        if(find)
            sortList(findList);
        else
            sortList(window.students);
    }
    
    var students = window.students;
    if(find)
        students = findList;
    
    var updown = (ascending)? "&nbsp;&nbsp;&nbsp;&nbsp;&#x25b2;" : "&nbsp;&nbsp;&nbsp;&nbsp;&#x25bc;";
        
    switch(column){
        case "no": headerRow[0].innerHTML += updown; break;
        case "name": headerRow[1].innerHTML += updown; break;
        case "surname": headerRow[2].innerHTML += updown; break;
        case "department": headerRow[3].innerHTML += updown; break;
    }

    var length = mTable.rows.length, c;
    
    for(c = length - 1; c > 2; c--)
        mTable.deleteRow(c);
    
    students.forEach(function(student, index) {
            if(index >= (page - 1) * 5 && index < page * 5)
                addNewRow(mTable, -1, student);
    });
    
    
}

function arrange(headerId, column, col, asc, page, where){
    /*var headerRow = header.parentElement.cells, column;
    for(var i = 0; i < 4; i++)
        headerRow[i].style.color = "";

    switch(header.id){
        case "hNo" : column = "no"; break;
        case "hName" : column = "name"; break;
        case "hSurname" : column = "surname"; break;
        case "hDepartment" : column = "department"; break;
    }*/

    /*switch(col){
        case "no": headerRow[0].innerHTML = "Student Number"; break;
        case "name": headerRow[1].innerHTML = "Name"; break;
        case "surname": headerRow[2].innerHTML = "Surname"; break;
        case "department": headerRow[3].innerHTML = "Department"; break;
    }*/

    if(column != col){
        col = column;
        asc = 'asc';
    }
    else
        asc = (asc == 'asc')? 'desc':'asc';

    //var request = new XMLHttpRequest();
    console.log(where);
    location.href = "?col=" + col + "&asc=" + asc + "&page=" + page + "&where=" + where;
    /*request.open("GET", "?col=" + col + "&asc=" + asc + "&page=" + page + "&where=" + where);//((where == "")? "":(
    request.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            window.document.body.innerHTML = this.responseText;

            var updown = (asc == 'asc')? "&nbsp;&nbsp;&nbsp;&nbsp;&#x25b2;" : "&nbsp;&nbsp;&nbsp;&nbsp;&#x25bc;";

            header = document.getElementById(headerId);
            header.innerHTML += updown;
            header.style.color = "#8888ff";
            console.log(header.innerHTML);
            /*switch(col){
                case "no": headerRow[0].innerHTML += updown; break;
                case "name": headerRow[1].innerHTML += updown; break;
                case "surname": headerRow[2].innerHTML += updown; break;
                case "department": headerRow[3].innerHTML += updown; break;
            }
        }
            //window.open("", "_self").document.write(this.responseText).print;
    };
    request.send();*/
    //showList(page, column, !ascending, find);
}

function findStudent(){
    var findNo = document.getElementById("findNo").value;
    var findName = document.getElementById("findName").value;
    var findSurname = document.getElementById("findSurname").value;
    var findDepartment = document.getElementById("findDepartment").value;
    
    if(findNo == "" && findName == "" && findSurname == "" && findDepartment == ""){
        window.alert("No information has been entered");
        return ;
    }
    var where = [findNo, findName, findSurname, findDepartment];
    var request = new XMLHttpRequest();
    request.open("GET", "?where=" + JSON.stringify(where));//json_encode(where)
    request.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200)
            window.document.body.innerHTML = this.responseText;
    };
    request.send();
    
}

function wipe(){
    var cells = document.getElementById('studentList').rows[1].cells;
    cells[0].firstElementChild.value = "";
    cells[1].firstElementChild.value = "";
    cells[2].firstElementChild.value = "";
    cells[3].firstElementChild.value = "";

    var request = new XMLHttpRequest();
    request.open("GET", "/");
    request.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200)
            window.document.body.innerHTML = this.responseText;
    };
    request.send();
}
