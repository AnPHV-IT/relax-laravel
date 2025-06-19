document.getElementById('add-category').addEventListener('click', function () {
    const categoriesDiv = document.getElementById('categories');
    const index = categoriesDiv.getElementsByClassName('category-input').length;

    const newCategoryDiv = document.createElement('div');
    newCategoryDiv.classList.add('form-group', 'category-input');
    newCategoryDiv.innerHTML = `
        <label for="category_${index}">Loại ${index + 1}</label>
        <input placeholder="Tên Phân Loại" type="text" name="categories[${index}]" id="category_${index}" class="form-control">
        <button type="button" class="my-2 remove-category btn btn-danger">Xóa</button>
    `;
    categoriesDiv.appendChild(newCategoryDiv);

    newCategoryDiv.querySelector('.remove-category').addEventListener('click', function () {
        newCategoryDiv.remove();
        updateRemoveButtons('category');
    });

    updateRemoveButtons('category');
});

document.getElementById('add-color').addEventListener('click', function () {
    const colorsDiv = document.getElementById('colors');
    const index = colorsDiv.getElementsByClassName('color-input').length;

    const newColorDiv = document.createElement('div');
    newColorDiv.classList.add('form-group', 'color-input');
    newColorDiv.innerHTML = `
        <label for="color_${index}">Màu ${index + 1}</label>
        <input placeholder="Tên Màu" type="text" name="colors[${index}][name]" id="color_${index}" class="form-control">
        <input type="file" class="form-control my-2" name="colors[${index}][image]" id="color_image_${index}">
        <button type="button" class="my-2 remove-color btn btn-danger">Xóa</button>
    `;
    colorsDiv.appendChild(newColorDiv);

    newColorDiv.querySelector('.remove-color').addEventListener('click', function () {
        newColorDiv.remove();
        updateRemoveButtons('color');
    });

    updateRemoveButtons('color');
});

function updateRemoveButtons(type) {
    const inputs = document.querySelectorAll(`.${type}-input`);
    inputs.forEach((input, index) => {
        const removeButton = input.querySelector(`.remove-${type}`);
        removeButton.style.display = inputs.length > 1 && index > 0 ? 'block' : 'none';
    });
}
