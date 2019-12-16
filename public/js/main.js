
function arrange(headerId, column, col, asc, page, where){

    if(column != col){
        col = column;
        asc = 'asc';
    }
    else
        asc = (asc == 'asc')? 'desc':'asc';

    location.href = "?col=" + col + "&asc=" + asc + "&page=" + page + "&where=" + where;
        
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
    request.open("GET", "?where=" + JSON.stringify(where));
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
