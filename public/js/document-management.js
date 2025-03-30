// Document Management System Enhancements

document.addEventListener('DOMContentLoaded', function() {
    // Real-time Search Functionality
    searchContainer.appendChild(searchInput);

    // Insert search container before the table
    const dataTable = document.querySelector('.data-table');
    if (dataTable) {
        dataTable.parentNode.insertBefore(searchContainer, dataTable);

        // Add real-time search functionality
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = dataTable.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                const rowText = Array.from(cells).map(cell => cell.textContent.toLowerCase()).join(' ');
                
                if (rowText.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }

    // File Upload Preview and Handling
    const fileInput = document.querySelector('input[type="file"]');
    if (fileInput) {
        // Create file preview container
        const filePreviewContainer = document.createElement('div');
        filePreviewContainer.classList.add('file-preview-container');
        fileInput.parentNode.appendChild(filePreviewContainer);

        // Add file preview functionality
        fileInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            filePreviewContainer.innerHTML = ''; // Clear previous preview

            if (file) {
                // Create file info element
                const fileInfo = document.createElement('div');
                fileInfo.classList.add('file-info');
                fileInfo.innerHTML = `
                    <strong>Archivo seleccionado:</strong>
                    <p>Nombre: ${file.name}</p>
                    <p>Tamaño: ${(file.size / 1024).toFixed(2)} KB</p>
                    <p>Tipo: ${file.type}</p>
                `;

                // File preview based on type
                if (file.type.startsWith('image/')) {
                    const img = document.createElement('img');
                    img.classList.add('file-preview-image');
                    img.file = file;
                    filePreviewContainer.appendChild(img);

                    const reader = new FileReader();
                    reader.onload = (e) => img.src = e.target.result;
                    reader.readAsDataURL(file);
                } else if (file.type === 'application/pdf') {
                    const pdfPreview = document.createElement('div');
                    pdfPreview.classList.add('pdf-preview');
                    pdfPreview.textContent = 'Vista previa de PDF no disponible';
                    filePreviewContainer.appendChild(pdfPreview);
                }

                filePreviewContainer.appendChild(fileInfo);
            }
        });
    }

    // Dynamic Classification Filter
    const addClassificationFilter = () => {
        const filterContainer = document.createElement('div');
        filterContainer.classList.add('classification-filter');
        
        const filterSelect = document.createElement('select');


        filterSelect.addEventListener('change', function() {
            const selectedClassification = this.value;
            const rows = dataTable.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const classificationCell = row.querySelector('td:nth-child(12)'); // Adjust index based on your table structure
                if (!selectedClassification || classificationCell.textContent === selectedClassification) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        filterContainer.appendChild(filterSelect);
        searchContainer.appendChild(filterContainer);
    };

    // Add classification filter if table exists
    if (dataTable) {
        addClassificationFilter();
    }
});