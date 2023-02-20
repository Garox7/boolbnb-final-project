require('./common');

// MY JavaScript
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

