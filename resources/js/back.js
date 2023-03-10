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
// bottone per aggiunta di ulteriori immagini
const input = document.querySelector('#image');
const preview = document.querySelector('#image-preview');
const addButton = document.querySelector('#add-image');

if(input && preview && addButton) {

    input.addEventListener('change', function () {
      preview.innerHTML = ''; // pulisce il contenitore delle anteprime
      const files = this.files;
      for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const reader = new FileReader();
        reader.onload = function (e) {
          const img = new Image();
          img.src = e.target.result;
          preview.appendChild(img);
        };
        reader.readAsDataURL(file);
      }
      addButton.classList.remove('d-none'); // rende visibile il pulsante per aggiungere altre immagini
      iput
    });

    addButton.addEventListener('click', function () {
      input.click(); // simula il click sull'input di file
    });
}

// index.blade.php
const deletePopup = document.querySelector('.delete-popup-backdrop');

if (deletePopup) {
    const deleteBtn = document.querySelectorAll('.delete-button');
    deleteBtn.forEach(button => {
        button.addEventListener('click', function() {
            console.log('cliccato');
            deletePopup.classList.remove('hidden');
            document.body.style.overflow = 'hidden';

            deletePopup.querySelector('form').setAttribute('action', 'http://localhost:8000/admin/properties/' + this.dataset.id);

        });
    });

    const cancelBtn = document.querySelector('.cancel-button');
    cancelBtn.addEventListener('click', function() {
        deletePopup.classList.add('hidden');
        document.body.style.overflow = 'visible';
    });

    function hideSuccessMessage() {
        deleteSuccess.classList.add('d-none');
    };

    const deleteSuccess = document.querySelector('.alert-danger');
    if(document.body.contains(deleteSuccess)) {
        setTimeout(hideSuccessMessage, 10000);
    };
}
