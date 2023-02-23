require('./common');

// MY JavaScript

//app.blade.php
const controlBtn = document.querySelector('.controls');
const dropMenu = controlBtn.querySelector('.drop-menu')

if (controlBtn && dropMenu) {
    controlBtn.addEventListener('click', function() {
        dropMenu.classList.toggle('hidden');
    })
}

// create.blade.php
const addButton = document.querySelector("#add-image");
const imageFields = document.querySelector("#image-fields");

if (addButton && imageFields) {
    let count = 1;

    addButton.addEventListener("click", function() {
    const newField = document.createElement("div");
    newField.innerHTML = `
        <div class="mb-3">
        <label for="image" class="form-label">Immagine ${++count}</label>
        <input type="file" class="form-control" id="image" name="image[]">
        </div>
    `;
    imageFields.appendChild(newField);
    });
}

// index.blade.php
const deleteBtn = document.querySelectorAll('.delete-button');
const deletePopup = document.querySelector('.delete-popup-backdrop');
const cancelBtn = document.querySelector('.cancel-button');
const deleteSuccess = document.querySelector('.alert-danger');

if (deleteBtn && deletePopup && cancelBtn) {
    deleteBtn.forEach(element => {
        element.addEventListener('click', function() {
            console.log('cliccato');
            deletePopup.classList.remove('hidden');
            document.body.style.overflow = 'hidden';

        });
    });

    cancelBtn.addEventListener('click', function() {
        deletePopup.classList.add('hidden');
        document.body.style.overflow = 'visible';
    });

    function hideSuccessMessage() {
        deleteSuccess.classList.add('d-none');
    };

    if(document.body.contains(deleteSuccess)) {
        setTimeout(hideSuccessMessage, 10000);
    };
}




