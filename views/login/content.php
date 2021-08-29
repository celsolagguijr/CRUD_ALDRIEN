<div class="loginContainer ">
    <div class="card" >
        <div class="card-body">
            <h5 class="card-title">Sign In</h5>
            <form method="POST" action="../../includes/users/login.php" id="login-form">
            <div class="form-floating mb-3 mt-3">
                <input type="text" class="form-control"  name="username">
                <label for="floatingInput">User Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control"   name="password">
                <label for="floatingPassword">Password</label>
            </div>
            <div id="alert"></div>
                <button type="submit" class="btn btn-primary" id="btn">Login</button>
            </form>
        </div>
    </div>
</div>


<script>
    const formLogin = document.getElementById("login-form");
    const alert =  document.getElementById("alert");
    const button = document.getElementById("btn");

    formLogin.addEventListener('submit',async function(e){
      e.preventDefault();
      button.innerText="Logging in...";
      button.classList.add("disabled");


      const username = this.username.value;
      const password = this.password.value;
        
      const response = await fetch(this.action, {
                            method: this.method, 
                            cache: 'no-cache', 
                            headers: {
                            'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                username : username,
                                password : password
                            })
                        });


      const result = await response.json();

      if(result.success){
        window.location.href = "../users";
      }


      alert.innerHTML=`<div class="alert alert-${result.success ? 'info' : 'danger'}" role="alert" id="alert">${result.msg}</div>`;
      button.innerText="Login";
      button.classList.remove("disabled");                 

    setTimeout(() => {
        alert.innerHTML=``;
    }, 3000);



  
    })
</script>