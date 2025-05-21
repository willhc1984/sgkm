document.getElementById('images').addEventListener('change', function(e){
    const files = e.target.files;
    const formData = new FormData();
    for(let i = 0; i < files.length; i++){
        formData.append('images[]', files[i]);
    }

    fetch(uploadRoute, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        //console.log("Resposta recebida: ", data);
        const container = document.getElementById('image-paths-container');
        const preview = document.getElementById('preview');
        container.innerHTML = '';
        preview.innerHTML = '';

        data.paths.forEach(path => {
            // Cria input oculto para enviar no formulário
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'uploaded_images[]';
            input.value = path;
            container.appendChild(input);

             // Cria preview
             const img = document.createElement('img');
             img.src = path;
             img.width = 150;
             img.style.padding ='10px';
             preview.appendChild(img);
        });
    })
    .catch(error => console.error('Erro no upload: ', error));

});