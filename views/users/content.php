<div class="loginContainer ">
    <div class="card" >
        <div class="card-body">
            <h5 class="card-title">Users</h5>
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Username</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody id="data-table">


                </tbody>
            </table>
            <div class="d-flex justify-content-end">
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-primary" id="btnPrev">Prev</button>
                <button type="button" class="btn btn-primary" id="btnNext">Next</button>
            </div>
            </div>
        </div>
    </div>
</div>


<script>

const table = document.getElementById("data-table");
const btnNxt = document.getElementById("btnNext");
const btnPrev = document.getElementById("btnPrev");


let allData =[]; 
let start = 0;
let limit = 5;


    btnNxt.addEventListener('click',function(e){
        e.preventDefault();
        start += 5;
        limit +=5 ; 
        table.innerHTML = [...allData].splice(start,limit).map(data=> row(data)).join(' ');
    })

    btnPrev.addEventListener('click',function(e){
        e.preventDefault();
        start -= 5;
        limit -=5 ; 
        table.innerHTML = [...allData].splice(start,limit).map(data=> row(data)).join(' ');

    })



    function row (data){

        return `<tr>
                    <th scope="row">${data.id}</th>
                    <td>${data.FirstName}</td>
                    <td>${data.LastName}</td>
                    <td>${data.LastName}</td>
                    <td></td>
                </tr>`;
    }

    async function loadData() {

        const response = await fetch('../../includes/users/loadData.php', {
                            method: 'GET', 
                            cache: 'no-cache', 
                            headers: {
                            'Content-Type': 'application/json'
                            }
                        });

        const {data} = await response.json();
        allData = [...data];
     
                        
    table.innerHTML = [...allData].splice(0,limit).map(data=> row(data)).join(' ');


    }







    loadData();
</script>