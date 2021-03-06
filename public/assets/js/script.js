let search = document.querySelector('#searchBox');
let table = document.querySelector('tbody');
let suggestions = document.querySelector('#suggestions');
let searchForm = document.querySelector('#searchForm');
let suppApp = document.querySelectorAll('.suppApp');


// suppApp.forEach(element => {
    
//     element.addEventListener('click', (e) => {
//         fetch(`/controllers/profil-patient-controller.php`, {
//             method: 'POST'
//         })
//         .then((response) => {
//             return response.json()
//         })
//     })
// });


search.addEventListener('keyup', (e) => {
    let value = e.target.value;
    fetch(`/controllers/liste-patient-controller.php?searchbox=${value}`, {
            method: 'GET'
        })
        .then((response) => {
            return response.json()
        })
        .then((data) => {
            search.length === 0 ? null :
                table.innerHTML = ''
            suggestions.innerHTML = ''
            data.data.forEach((item, index) => {
                $date = new Date(item.birthdate).toLocaleDateString("fr")
                table.innerHTML += `
            <tr>
            <td>${item.id}</td>
            <td>${item.firstname}</td>
            <td>${item.lastname}</td>
            <td>${$date}</td>
            <td><a href="tel:${item.phone}">${item.phone}</a></td>
            <td><a href="mailto:${item.mail}">${item.mail}</a></td>
            <td class ="activeCase"><a href="/profil-patient?id=${item.id}"> Voir le profil </a></td>
            <td class="delete"><a href="/supprimer-patient?id=${item.id}">Supprimer le patient</a> </td>
            </tr>`

                if (data.search === true) {
                    suggestions.innerHTML += ` 
                                <li id = "${item.lastname}" class = "autoComplete" >${item.lastname} ${item.firstname}</li>
                            `
                }

            })
        })
        .finally( ()=>{
            let autoComplete = document.querySelectorAll('.autoComplete');
            autoComplete.forEach(element => {
                element.addEventListener('click', (e) => {
                    search.value=e.currentTarget.id;
                    searchForm.submit();
                })
            })
        })
})

