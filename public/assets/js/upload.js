/* 
       IMAGE PREVIEW
*/
const imgInput = document.getElementById("prodImage");
const previewWrap = document.getElementById("previewWrap");

if (imgInput) {
    imgInput.addEventListener("change", function () {
        const file = this.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = e => {
                previewWrap.innerHTML = `
                    <img src="${e.target.result}" style="width:100%;border-radius:12px;margin-top:12px;">
                `;
            };
            reader.readAsDataURL(file);
        }
    });
}