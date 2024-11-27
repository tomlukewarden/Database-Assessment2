document.addEventListener('DOMContentLoaded', () => {
    const editButtons = document.querySelectorAll('.edit-button');
    const modal = document.getElementById('editModal');
    const closeButton = document.getElementById('closeModal');
    let bootstrapModal; // Declare this at the top for global scope within the script.

    // Modal input fields
    const staffIdInput = document.getElementById('staffId');
    const nameInput = document.getElementById('name');
    const positionInput = document.getElementById('position');
    const storeIdInput = document.getElementById('storeId');
    const salaryInput = document.getElementById('salary');

    editButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Get data attributes from the clicked button
            const staffId = button.getAttribute('data-staff-id');
            const name = button.getAttribute('data-name');
            const position = button.getAttribute('data-position');
            const storeId = button.getAttribute('data-store-id');
            const salary = button.getAttribute('data-salary');

            // Populate the modal fields with the data
            staffIdInput.value = staffId;
            nameInput.value = name;
            positionInput.value = position;
            storeIdInput.value = storeId;
            salaryInput.value = salary;

            // Initialize and show the modal
            bootstrapModal = new bootstrap.Modal(modal);
            bootstrapModal.show();
        });
    });

    // Close the modal when the close button is clicked
    closeButton.addEventListener('click', () => {
        if (bootstrapModal) {
            bootstrapModal.hide();
        }
    });

    // Handle form submission
    document.getElementById('editForm').addEventListener('submit', (e) => {
        e.preventDefault(); // Prevent default form submission

        const formData = new FormData(e.target);

        fetch('update_staff.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data); // Display a success message
            if (bootstrapModal) {
                bootstrapModal.hide(); // Close the modal
            }
            location.reload(); // Reload the page to update the table
        })
        .catch(err => console.error('Error:', err));
    });
});
