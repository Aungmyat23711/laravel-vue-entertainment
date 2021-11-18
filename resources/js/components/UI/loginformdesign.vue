 <br>
      <div class="frame">
         <h1 align='center' class="ex">Exchange Myanmar</h1>
      </div><br>
      <div id="body">
        <div class="container">
         <div class="row">
             <div class="col-md-6">
              <table class="table table-dark tab" align='center'>
  <thead>
      <tr>
                <th scope="col">Currency</th>
                <th scope="col">Rate</th>
      </tr> 
      <tr v-for="(index,key) in exchangedata" :key="key">
           <td scope="col">{{key}}</td>
           <td scope="col">{{index}}</td>
       </tr>
  </thead>
</table>
         </div>
         
          <div class="col-md-6">
              <table class="table table-dark tab" align='center'>
  <thead>
      <tr>
                <th scope="col">Country</th>
                <th scope="col">Currencies</th>
      </tr> 
      <tr v-for="(index,key) in exchangecurrency" :key="key">
           <td scope="col">{{key}}</td>
           <td scope="col">{{index}}</td>
       </tr>
  </thead>
</table>
         </div>
         </div>
     </div>
      </div>