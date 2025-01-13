














function fetchdata(controller, id, type) {
    if (confirm(`Are you sure you want to delete this ${type}?`)) {
        fetch(`../../controllers/${controller}.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `action=delete&id=${id}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(`${type} deleted successfully!`);
                document.querySelector(`a[data-id="${id}"]`).closest('tr').remove();
            } else {
                alert(`Error deleting ${type}: ` + data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }
}
