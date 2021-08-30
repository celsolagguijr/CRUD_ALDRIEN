<div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <form method="PUT" action="../../includes/users/editUser.php" id="editUser">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            
                    <h6 class="modal-title">User Info</h6>
                    <hr>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" required  name="fName">
                        <input type="hidden" class="form-control"  required name="id">
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
                    <div id="alertEdit"></div>
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
    const editForm = document.getElementById("editUser");
    const alertEdit =  document.getElementById("alertEdit");

    editForm.addEventListener('submit',async function (e){
        e.preventDefault();

        const response = await fetch(this.action, {
                            method: 'PUT', 
                            cache: 'no-cache', 
                            headers: {
                            'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                              id : this.id.value,
                              fName : this.fName.value,
                              lName : this.lName.value,
                              uName : this.uName.value
                            })
                        });


    const result = await response.json();
    await loadData();

    alertEdit.innerHTML=`<div class="alert alert-${result.success ? 'info' : 'danger'}" role="alert" id="alert">${result.msg}</div>`;
    setTimeout(() => {
        alertEdit.innerHTML=``;
    }, 3000);


    })

</script>