var objData = [];

$(function() {
    getDataList();
})

function getDataList() {
    $.post('http://localhost/bscs/api/getstudents/', function(data) {
        objData = data;
        tblString = "";
        console.log(objData.data);
        objData.data.forEach(e => {
            tblString += `
                <tr>
                    <td>${e.fld_recno}</td>
                    <td>${e.fld_fname}</td>
                    <td>${e.fld_mname || ''}</td>
                    <td>${e.fld_lname}</td>
                    <td>${e.fld_extname || ''}</td>
                    <td>${e.fld_age}</td>
                    <td>
                        <button class="btn btn-warning" onclick="setArchive(${e.fld_recno}, 1)">Archive</button>
                    </td>
                </tr>
            `;
        });
        document.getElementById('rList').innerHTML = tblString;
        $('#rList').html(tblString);
    });
}

function setArchive(vRecno, vVal) {
    let load = { payload: {
        recno: vRecno,
        isdeleted: vVal
    }}
    $.post('http://localhost/bscs/api/setarchive/', JSON.stringify(load),function(data) {
        getDataList();
    });
}

function addRecord() {
    let load = { payload: {
        "fname": document.getElementById('fname').value,
        "mname": document.getElementById('mname').value,
        "lname": document.getElementById('lname').value,
        "extname": document.getElementById('extname').value,
        "age": document.getElementById('age').value
    }}

    $.post('http://localhost/bscs/api/addstudent/', JSON.stringify(load),function(data) {
        console.log("success");
        //this.getDataList();
    });
}