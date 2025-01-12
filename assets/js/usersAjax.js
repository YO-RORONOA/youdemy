document.querySelectorAll('.delete-btn').forEach(button=>
    {
        button.addEventListener('click', function()
    {
        if(confirm('Are you sure you want to delete this user?'))
        {
            let userId = this.getAttribute('data-id');
            console.log("Category ID:", categoryId);
    
            fetch('../controllers/categorieController.php',
            {
                method: 'POST',
                headers:
                {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
    
                body: `action=delete&user_id=${userId}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
    
                    alert('user deleted successfully!');
                    this.closest('tr').remove();
                } else {
                    alert('Error deleting user: ' + data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        }
    });
    });