document.addEventListener("DOMContentLoaded", () => {
    const editButton = document.getElementById("editButton");
    const form = document.getElementById("profileForm");
    const inputs = document.querySelectorAll("#profileForm input:not([type='file'])");
    const profilePictureInput = document.getElementById("profilePicture");
    const cvInput = document.getElementById("cv");
    let isEditing = false;

    function toggleEdit() {
        isEditing = !isEditing;

        inputs.forEach(input => input.disabled = !isEditing);
        profilePictureInput.disabled = !isEditing;
        cvInput.disabled = !isEditing;

        const editIcon = document.querySelector("#profilePictureLabel span");
        if (editIcon) {
            editIcon.classList.toggle("hidden", !isEditing);
        }

        editButton.innerText = isEditing ? "Save Changes" : "Edit Profile";

        if (!isEditing) {
            form.submit(); // Only submit when clicking "Save Changes"
        }
    }

    function previewImage(event) {
        const file = event.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = () => {
            document.getElementById("preview").src = reader.result;
        };
        reader.readAsDataURL(file);
    }

    editButton.addEventListener("click", toggleEdit);
    profilePictureInput.addEventListener("change", previewImage);
});
