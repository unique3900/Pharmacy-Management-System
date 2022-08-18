// toggle side bar ko lagi

const menuBar = document.querySelector('.side_btn');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
sidebar.classList.toggle('hide');
})
// If user adds a note, add it to the localStorage
let addBtn = document.getElementById("addBtn");
addBtn.addEventListener("click", function (e) {
    let addTit = document.getElementById("addTitle");
    let addDesc = document.getElementById("addDesc");
    let notes = localStorage.getItem("notes");
    if (notes == null) {
        notesObj = [];
    } else {

        //Json .parse use garnu ko karan vaneko input text lai JS object ko form ma transfer garnu ho...yo object lai localstorage ma push garne paxi
        notesObj = JSON.parse(notes);
    }

    let myObj = {
        title: addTit.value.toUpperCase(),
        desc: addDesc.value
    }
    notesObj.push(myObj);
    localStorage.setItem("notes", JSON.stringify(notesObj));
    addTit.value = "";
    addDesc.value = "";
    showNotes();

})

function showNotes() {
    let notes = localStorage.getItem("notes");
    if (notes == null) {
        notesObj = [];
    } else {
        notesObj = JSON.parse(notes);
    }
    let html = " ";

    //Since note Js object ko form ma inserted huncha we need to fetch one by one so we use for each
    notesObj.forEach(function (element, index) {
        html += `
        <div class="dispnote">
                    <div class="notecard">
                        <div class="noteDispContainer">
                            <h4><b>Note ${index + 1} :</b> <i> ${element.title} </i> </h4>

                            <p> ${element.desc}</p>


                            <input type="submit" id="${index}"onclick="deleteNote(this.id)" value="Delete">





                        </div>
                    </div>

                </div>`;
        // console.log(element,index);

    });
    let notesElm = document.getElementById("notes");
    if (notesObj.length != 0) {
        notesElm.innerHTML = html;
    }
    else {
        notesElm.innerHTML = `Nothing to Show Add a New Note`;
    }
}



// dELETE NOTE fUNCTION
function deleteNote(index){
    console.log("I am Deleting", index);
    let notes = localStorage.getItem("notes");
    if (notes == null) {
        notesObj = [];
    } else {
        notesObj = JSON.parse(notes);
    }
    notesObj.splice(index, 1);  //Notes obj ko kun index bata kati ota element delete garne vanna khojeko ho
    

    //Yetti Garyo vane ne delete hunna kinaki localstorage update nei vayeko chaina so,, we do


    // Json stringify le JS object like array lai string ko form ma change garna kam lagcha
    localStorage.setItem("notes", JSON.stringify(notesObj));

    showNotes();
}



// Search Functionality
let search = document.getElementById('searchTxt');
search.addEventListener("input", function (e) {

    let inputVal = search.value.toUpperCase();
    let noteCards = document.getElementsByClassName('noteDispContainer');
    console.log("Input Event Fired", inputVal);


    ///Hamro Notes Cards ko form ma rakheko xam so we need to do foreach in those card to search
    Array.from(noteCards).forEach(function (element) {


        //Traverse Garda card ko tag name ma scan gareko
        let cardText = element.getElementsByTagName("h4")[0].innerText;
         console.log(cardText);
        if (cardText.includes(inputVal)) {
            element.style.display = "block";
        }
        else {
            element.style.display = "none";
        }
    });

});
