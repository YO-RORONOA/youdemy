document.querySelectorAll('.delete-btn').forEach(button=>
    {
        button.addEventListener('click', function()
    {
        if(confirm('Are you sure you want to delete this user?'))
        {
            let userId = this.getAttribute('data-id');
            console.log("Category ID:", userId);
    
            fetch('../admin/userControl.php',
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





    document.querySelectorAll('.suspend-btn').forEach(button=>
        {
            button.addEventListener('click', function()
        {
            if(confirm('Are you sure you want to suspend this user?'))
            {
                let userId = this.getAttribute('data-id');
                console.log("Category ID:", userId);
        
                fetch('../admin/userControl.php',
                {
                    method: 'POST',
                    headers:
                    {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
        
                    body: `action=suspend&user_id=${userId}`
                    
                })
                .then(response => response.json())
                .then(data => {
                    console.log("Server Response:", data);                    if (data.success) {
        
                        alert('user suspended successfully!');

                        // this.closest('tr').remove();
                    } else {
                        alert('Error suspending user: ' + data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        });
        });




        document.querySelectorAll('.activate-btn').forEach(button=>
            {
                button.addEventListener('click', function()
            {
                if(confirm('Are you sure you want to activate this user?'))
                {
                    let userId = this.getAttribute('data-id');
            
                    fetch('../admin/userControl.php',
                    {
                        method: 'POST',
                        headers:
                        {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
            
                        body: `action=activate&user_id=${userId}`
                        
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        if (data.success) {
            
                            alert('user activated successfully!');
                            // this.closest('tr').remove();
                        } else {
                            alert('Error activating user: ' + data.message);
                        }
                    })
                    .catch(error => console.error('Error:', error));
                }
            });
            });