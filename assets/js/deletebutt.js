
document.querySelectorAll('.suppression').forEach(button=>
    {
        console.log('button found')
        button.addEventListener('click', function()
    {
        if(confirm('Are you sure you want to delete this category?'))
        {
            let categoryId = this.getAttribute('data-id');
            console.log("Category ID:", categoryId);
    
            fetch('../../controllers/categorieController.php',
            {
                method: 'POST',
                headers:
                {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
    
                body: `action=delete&category_id=${categoryId}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
    
                    alert('Category deleted successfully!');
                    this.closest('tr').remove(); // Remove the category row dynamically
                } else {
                    alert('Error deleting category: ' + data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        }
    });
    });
    
    