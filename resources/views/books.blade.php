<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Lista libri') }}
        </h2>
    </x-slot>


    <main class="container mt-5 shadow p-3 bg-white">
        <h2 class="h2">Esplora la libreria!</h2>

        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
            <!-- Input di ricerca con classi Bootstrap per styling -->
                    <input type="text" id="book-search" class="form-control mb-3" placeholder="Cerca libri...">
            <!-- Contenitore dei risultati con un po' di padding -->
                     <!-- <div id="book-search-results" class="results-container p-3" style="position: relative; z-index: 1000; background-color: white;"></div> -->
                </div>
            </div>
        </div>


        <table class="table">
            <thead>
                
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titolo Libro</th>
                    <th scope="col">Autore</th>
                    <th scope="col" style="text-align: center;">Copie disponibili</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ($bookList as $book)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{$book->title}}</td>
                        <td>{{$book->author}}</td>
                        <td class="text-center">{{$book->copies_available}}</td>
                        <td><a href="/book/{{$book->id}}"><i class="bi bi-ticket-detailed"></i></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table> 

        <div class="d-flex  justify-content-center" id="pagination"></div> <!-- Assicurati di avere questo elemento sotto la tua tabella -->
        
            
        <div id="laravel-pagination" >
            {{ $bookList->links() }}
        </div>

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
let currentSearchQuery = ''; // Variabile per tenere traccia della query di ricerca corrente

// Funzione per eseguire la ricerca e aggiornare l'UI
function searchBooks(query, page = 1) {
    currentSearchQuery = query; // Aggiorna la query corrente

    fetch(`http://127.0.0.1:8000/books/search?query=${encodeURIComponent(query)}&page=${page}`)
        .then(response => response.json())
        .then(data => {
            const tableBody = document.querySelector('.table tbody');
            tableBody.innerHTML = ''; // Pulisci la tabella dai risultati precedenti
            document.getElementById('laravel-pagination').style.display = 'none';
            console.log(data);

            // Aggiungi i nuovi risultati della ricerca alla tabella
            data.data.forEach((book, index) => {
                const row = tableBody.insertRow();
                // Calcola il numero di sequenza basato sulla pagina corrente e risultati per pagina
                row.insertCell(0).innerHTML = ((data.current_page - 1) * data.per_page) + index + 1;
                row.insertCell(1).textContent = book.title;
                row.insertCell(2).textContent = book.author;
                row.insertCell(3).innerHTML = `<div class="text-center">${book.copies_available}</div>`;
                row.insertCell(4).innerHTML = `<a href="/book/${book.id}"><i class="bi bi-ticket-detailed"></i></a>`;
            });

            updatePagination(data.current_page, data.last_page);
        })
        .catch(error => console.error('Errore:', error));
}

// Funzione per aggiornare i controlli di paginazione
function updatePagination(currentPage, totalPages) {
    const pagination = document.getElementById('pagination');
    pagination.innerHTML = ''; // Pulisci i vecchi controlli di paginazione

    // Bottoni di paginazione
    if (currentPage > 1) {
        const prevBtn = document.createElement('button');
        prevBtn.textContent = '« Previous';
        prevBtn.classList.add('pagination-btn')
        prevBtn.onclick = () => searchBooks(currentSearchQuery, currentPage - 1); // Passa la query corrente
        pagination.appendChild(prevBtn);
    }

    if (currentPage < totalPages) {
        const nextBtn = document.createElement('button');
        nextBtn.textContent = 'Next »';
        nextBtn.classList.add('pagination-btn-yellow')
        nextBtn.onclick = () => searchBooks(currentSearchQuery, currentPage + 1); // Passa la query corrente
        pagination.appendChild(nextBtn);
    }
}

// Event listener per la ricerca
document.getElementById('book-search').addEventListener('input', function() {
    const query = this.value.trim(); // Rimuovi spazi bianchi non necessari
    if (query) { // Verifica se la query non è vuota
        searchBooks(query); // Inizia la ricerca con la query fornita e pagina predefinita a 1
    }
});
</script>





</x-app-layout>