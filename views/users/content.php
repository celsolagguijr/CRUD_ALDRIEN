<div class="loginContainer ">
    <div class="card" >
        <div class="card-body">

        <div class="d-flex justify-content-between mb-2">
            <h5 class="card-title">Users</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
           Add
            </button>

        </div>
        <div class="mb-2">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control form-control-sm"  required id="txtSrch">
                    <label for="floatingPassword">Search</label>
                </div>
        </div>
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
            <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-primary" id="btnMore">Load More</button>
            <!-- <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-primary" id="btnPrev">Prev</button>
                <button type="button" class="btn btn-primary" id="btnNext">Next</button>
            </div> -->
            </div>
        </div>
    </div>
</div>


<script>

    const table = document.getElementById("data-table");
    const btnMore = document.getElementById("btnMore");


    // temp storage
    let allData =[]; 
    let limit = 5; 


    function row (data){

        return `<tr>
                    <th scope="row">${data.id}</th>
                    <td>${data.FirstName}</td>
                    <td>${data.LastName}</td>
                    <td>${data.UserName}</td>
                    <td>
                        <button type="button" class="btn btn-success edit" data-id="${data.id}" >Edit</button>
                        <button type="button" class="btn btn-danger del" data-id="${data.id}" >Delete</button>
                    </td>
                </tr>`;
    }





    
    btnMore.addEventListener('click',function(e){
        e.preventDefault();
        limit +=5 ; 
        table.innerHTML = [...allData].splice(0,limit).map(data=> row(data)).join(' ');
      

        document.querySelectorAll(".edit").forEach(element => {
            element.addEventListener('click',function(e){
                
                const id =  this.getAttribute("data-id");
                const dataInd = [...allData].findIndex(data => data.id === id);
                const formData = allData[dataInd];

                editForm.id.value= id;
                editForm.fName.value=formData.FirstName;
                editForm.lName.value=formData.LastName;
                editForm.uName.value=formData.UserName;

                const editModal = new bootstrap.Modal(document.getElementById('editModal'), {
                    keyboard: false
                });
                
                editModal.show();

            })
        });


        document.querySelectorAll(".del").forEach(element => {

            element.addEventListener('click',async function(e){
                
                const id =  this.getAttribute("data-id");

                const response = await fetch("../../includes/users/deleteUser.php", {
                            method: 'PUT', 
                            cache: 'no-cache', 
                            headers: {
                            'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                id : id
                            })
                        });
                        

                await loadData();
            })
        });



    });


    document.getElementById("txtSrch").addEventListener('keyup',async function(e){

        const response = await fetch('../../includes/users/searchUser.php?txtSearch='+this.value, {
                            method: 'GET', 
                            cache: 'no-cache', 
                            headers: {
                            'Content-Type': 'application/json'
                            },
                           
                        });

        const {data} = await response.json();
        allData = [...data];
     
                        
        table.innerHTML = [...allData].splice(0,limit).map(data=> row(data)).join(' ');

        document.querySelectorAll(".edit").forEach(element => {
        element.addEventListener('click',function(e){
            
            const id =  this.getAttribute("data-id");
            const dataInd = [...allData].findIndex(data => data.id === id);
            const formData = allData[dataInd];
            
            editForm.id.value= id;
            editForm.fName.value=formData.FirstName;
            editForm.lName.value=formData.LastName;
            editForm.uName.value=formData.UserName;

            const editModal = new bootstrap.Modal(document.getElementById('editModal'), {
                keyboard: false
            });
            editModal.show();

        })
        });
 
        document.querySelectorAll(".del").forEach(element => {

            element.addEventListener('click',async function(e){
                
                const id =  this.getAttribute("data-id");

                const response = await fetch("../../includes/users/deleteUser.php", {
                            method: 'PUT', 
                            cache: 'no-cache', 
                            headers: {
                            'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                id : id
                            })
                        });
                        

                await loadData();
            })
        });
   },false)

    


    async function loadData() {

        // fetch api json data
        const response = await fetch('../../includes/users/loadData.php', {
                            method: 'GET', 
                            cache: 'no-cache', 
                            headers: {
                            'Content-Type': 'application/json'
                            }
                        });

        // { data } this is used to get the specific property that you want to access
        const {data} = await response.json();
        

        // ...data copy data into new array;
        allData = [...data];
     
        // display data in table
        // after copying the data cut it from 0 to 5 then 
        // use map to loop into it row function will return a text of row data 
        // then use join to merge all array date into text

        table.innerHTML = [...allData].splice(0,limit).map(data=> row(data)).join(' ');



        // select all edit classes then add event listener for each
        document.querySelectorAll(".edit").forEach(element => {
            element.addEventListener('click',function(e){
                
                const id =  this.getAttribute("data-id");
                const dataInd = [...allData].findIndex(data => data.id === id);
                const formData = allData[dataInd];
                
                editForm.id.value= id;
                editForm.fName.value=formData.FirstName;
                editForm.lName.value=formData.LastName;
                editForm.uName.value=formData.UserName;

                const editModal = new bootstrap.Modal(document.getElementById('editModal'), {
                    keyboard: false
                });
                editModal.show();

            })
        });
 
        // select all del classes then add event listener for each
        document.querySelectorAll(".del").forEach(element => {

            element.addEventListener('click',async function(e){
                
                const id =  this.getAttribute("data-id");

                const response = await fetch("../../includes/users/deleteUser.php", {
                            method: 'PUT', 
                            cache: 'no-cache', 
                            headers: {
                            'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                id : id
                            })
                        });
                        

                await loadData();
            })
        });


    }


    // loadData on page load
    (
        function() {
            loadData();
        }
    )()




    // trash

    // btnEdit.addEventListener('click',function(e) {

    //     e.preventDefault();
        
    //     const id = this.getAttribute("data-id");

    //     alert(id);
    // })


    // let start = 0;
    // const btnNxt = document.getElementById("btnNext");
    // const btnPrev = document.getElementById("btnPrev");
    // btnNxt.addEventListener('click',function(e){
    //     e.preventDefault();
    //     start += 5;
    //     limit +=5 ; 
    //     table.innerHTML = [...allData].splice(start,limit).map(data=> row(data)).join(' ');
    // })

    // btnPrev.addEventListener('click',function(e){
    //     e.preventDefault();
    //     start -= 5;
    //     limit -=5 ; 
    //     table.innerHTML = [...allData].splice(start,limit).map(data=> row(data)).join(' ');

    // })
  // trash

   
</script>