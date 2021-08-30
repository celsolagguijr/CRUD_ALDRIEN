<div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <form method="POST" action="../../includes/users/addUser.php" id="addUser">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            
                    <h6 class="modal-title">User Info</h6>
                    <hr>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" required  name="fName">
                        <label for="floatingPassword">Firstname</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control"  required name="lName">
                        <label for="floatingPassword">Lastname</label>
                    </div>


                    <h6 class="modal-title">User Account</h6>
                    <hr>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control"  required name="uName">
                        <label for="floatingPassword">Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" required  name="password">
                        <label for="floatingPassword">Password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" required name="cPassword">
                        <label for="floatingPassword">Confirm Password</label>
                    </div>
                    <div id="alert"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn text-primary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </div>
        </div>
    </form>
</div>

<script>
    const form = document.getElementById("addUser");
    const alert =  document.getElementById("alert");

    form.addEventListener('submit',async function (e){
        e.preventDefault();
        
        const cPassword = this.cPassword.value;
        const password = this.password.value;


        if(cPassword !== password){

            alert.innerHTML=`<div class="alert alert-danger" role="alert" id="alert">Password not match</div>`;
            setTimeout(() => {
                alert.innerHTML=``;
            }, 3000);
            return;
        }


        const response = await fetch(this.action, {
                            method: this.method, 
                            cache: 'no-cache', 
                            headers: {
                            'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                              fName : this.fName.value,
                              lName : this.lName.value,
                              uName : this.uName.value,
                              password : password
                            })
                        });


      const result = await response.json();


      if(result.success){
          this.reset();
          await loadData();
      }

    alert.innerHTML=`<div class="alert alert-${result.success ? 'info' : 'danger'}" role="alert" id="alert">${result.msg}</div>`;
    setTimeout(() => {
        alert.innerHTML=``;
    }, 3000);






    })

</script>