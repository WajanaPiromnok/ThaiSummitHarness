var app = new Vue({
    el: '#app',
    data: {
      users:"",
      message: 'พนักงานใน บริษัท ไทยซัมมิท ฮาร์เนส',
      form:{
          id:"",
          fname:"",
          position:"",
          num:"",
          isEdit:false,
          status:"บันทึก"
      }
    },
    methods:{
      submitData(e){
        e.preventDefault();
        check = (this.form.fname != "" && this.form.num != "");
        if(check && !this.form.isEdit){
          //บันทึกข้อมูล
          axios.post('action.php',{
            fname:this.form.fname,
            position:this.form.position,
            num:this.form.num,
            action:"insert"
          }).then(function(res){
              app.resetData();
              app.getAllUsers();
          })
        }
        if(check && this.form.isEdit){
          //อัพเดทข้อมูล
          axios.post('action.php',{
            id:this.form.id,
            fname:this.form.fname,
            position:this.form.position,
            num:this.form.num,
            action:"update"
          }).then(function(res){
              app.resetData();
              app.getAllUsers();
          })
        }
      },
      resetData(e){
        this.form.id="";
        this.form.fname="";
        this.form.position="";
        this.form.num="";
        this.form.status="บันทึก";
        this.form.isEdit=false;
        },
        getAllUsers(){
          axios.post('action.php',{
            fname:this.form.fname,
            position:this.form.position,
            num:this.form.num,
            action:"getAll"
          }).then(function(res){
              app.users=res.data              
          })
        },
        editUser(id){
            this.form.status="อัพเดท";
            this.form.isEdit=true;
            axios.post('action.php',{
              fname:this.form.fname,
              position:this.form.position,
              num:this.form.num,
              action:"getEditUser",
              id:id
            }).then(function(res){
                app.form.id=res.data.id;
                app.form.fname=res.data.fname;
                app.form.position=res.data.position;
                app.form.num=res.data.num;
            })
        },
        deleteUser(id){
          if(confirm("คุณต้องการลบ "+id+" หรือไม่ ?")) {
            axios.post('action.php',{
              fname:this.form.fname,
              position:this.form.position,
              num:this.form.num,
              action:"deleteUser",
              id:id
            }).then(function(res){
              alert(res.data.message);
              app.resetData();
              app.getAllUsers();
            })
        }
      }
    },
    created(){
      this.getAllUsers();
    }
  })