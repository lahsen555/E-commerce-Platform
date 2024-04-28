<style>
    /* Customize the label (the container) */
.container {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.container .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}

form {
    position: relative;
    top: 40%;
    left: 35%;

    border: 1px solid black;
    border-radius: 5px;
    background-color: #6396be;
    width: 400px;
   
    align-items: center;
    padding: 20px;
}

body{
    overflow: hidden;
}

</style>

<body>
    
    <form method="POST" action="{{ route('signale.store') }}" >
        @method('POST')
        @csrf
        
              <label class="container">This user is a scammer
                <input type="checkbox" name="sca">
                <span class="checkmark"></span>
              </label>
              
              <label class="container">This user is selling illegal products
                <input type="checkbox" name="ill">
                <span class="checkmark"></span>
              </label>
              
              <label class="container">This user is putting bad pictures
                <input type="checkbox" name="pis">
                <span class="checkmark"></span>
              </label>
              
              <label class="container">This user is putting Bad prices 
                <input type="checkbox" name="pri">
                <span class="checkmark"></span>
              </label>

              <input type="hidden" name="uid" value="{{$uid}}">

              <input type="hidden" name="email" value="{{$email}}">

              <input type="submit" value="Send" style="font-size: 15px; width: 100px; height: 30px;">
        </form>
    </body>
