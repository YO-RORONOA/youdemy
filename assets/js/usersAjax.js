document.addEventListener('DOMContentLoaded', function () {
    // Activate Button
    document.querySelectorAll('.activate-btn').forEach(button => {
        button.addEventListener('click', function () {
            if (confirm('Are you sure you want to activate this user?')) {
                let userId = this.getAttribute('data-id');

                fetch('../admin/userControl.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `action=activate&user_id=${userId}`
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('User activated successfully!');

                            const row = this.closest('tr');
                            row.querySelector('.statub').classList.remove('badge-warning');
                            row.querySelector('.statub').classList.add('badge-success');
                            row.querySelector('.statub').textContent = 'Active';
                            this.style.display = 'none';
                            row.querySelector('.suspend-btn').style.display = 'inline-block';
                            row.querySelector('.delete-btn').style.display = 'inline-block';
                        } else {
                            alert('Error activating user: ' + data.message);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        });
    });

    // Suspend Button
    document.querySelectorAll('.suspend-btn').forEach(button => {
        button.addEventListener('click', function () {
            if (confirm('Are you sure you want to suspend this user?')) {
                let userId = this.getAttribute('data-id');

                fetch('../admin/userControl.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `action=suspend&user_id=${userId}`
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('User suspended successfully!');

                            const row = this.closest('tr');
                            row.querySelector('.statub').classList.remove('badge-success');
                            row.querySelector('.statub').classList.add('badge-warning');
                            row.querySelector('.statub').textContent = 'Suspended';
                            this.style.display = 'none';
                            row.querySelector('.activate-btn').style.display = 'inline-block';
                            row.querySelector('.delete-btn').style.display = 'inline-block';

                        } else {
                            alert('Error suspending user: ' + data.message);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        });
    });

    // Delete Button
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {
            if (confirm('Are you sure you want to delete this user?')) {
                let userId = this.getAttribute('data-id');

                fetch('../admin/userControl.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `action=delete&user_id=${userId}`
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('User status changed to Deleted!');

                            const row = this.closest('tr');
                            row.querySelector('.statub').className = 'statub badge badge-secondary';
                            row.querySelector('.statub').textContent = 'Deleted';
                            this.style.display = 'none';
                            row.querySelector('.activate-btn').style.display = 'inline-block';
                            row.querySelector('.suspend-btn').style.display = 'inline-block';
                            
                        } else {
                            alert('Error deleting user: ' + data.message);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        });
    });
});