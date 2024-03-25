<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book List') }}
        </h2>
    </x-slot>

    <!-- <input type="text" name="search" id="search"> -->
    
    <main class="container mt-5 shadow p-3 bg-white">
        <h2 class="h2">Our amazing library!</h2>

        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
            <!-- Input di ricerca con classi Bootstrap per styling -->
                    <input type="text" id="book-search" class="form-control mb-3" placeholder="Cerca libri...">
            <!-- Contenitore dei risultati con un po' di padding -->
                     <div id="book-search-results" class="results-container p-3" style="position: relative; z-index: 1000; background-color: white;"></div>
                </div>
            </div>
        </div>


        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Book Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Aviable Copies</th>
                    <th scope="col">Aviable Copies</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookList as $book)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{$book->title}}</td>
                        <td>{{$book->author}}</td>
                        <td>{{$book->copies_available}}</td>
                        <td><a href="/book/{{$book->id}}"><i class="bi bi-ticket-detailed"></i></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        

    </main>


    <!-- <script>
        document.querySelector("#search").addEventListener("keyup", ()=>search());
        function search(query){

            let input = document.querySelector('#search').value;

            fetch("http://127.0.0.1:8000/search")
            .then((response)=>response.json())
            .then(json=>console.log(json));
        }
    </script> -->
    <script>
document.getElementById('book-search').addEventListener('input', function() {
    const query = this.value;
    console.log(query);
    console.log("Termine di ricerca inviato:", (query));

    fetch(`http://127.0.0.1:8000/books/search?query=${(query)}`)

        .then(response => response.json())
        .then(books => {
            console.log(books);
            const resultsContainer = document.getElementById('book-search-results');
            resultsContainer.innerHTML = ''; // Pulisci i risultati precedenti
            books.forEach(book => {
            const div = document.createElement('div');
            div.textContent = book.title; // Assumi che ogni libro abbia un titolo
            div.style.cursor = 'pointer';
            div.addEventListener('click', () => {
            window.location.href = `/book/${book.id}`; // Usa l'URL definito nella route
    });
    resultsContainer.appendChild(div);
});

        })
        .catch(error => console.error('Errore:', error));
});

</script>


</x-app-layout>