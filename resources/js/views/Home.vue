<template>
    <div class="container">
        <v-row>
            <v-col cols="4" >
                <v-card style="height: 92vh; position: relative;">
                    <v-toolbar color="#4a4a8f" dark style="font-size:17px"> 
                            CUSTOMER INFORMATION
                    </v-toolbar>
                    <br>
                        <div>
                            <v-col>
                               <v-text-field v-model="obj.firstname" label="FIRST NAME :" outlined dense autofocus required
                                                    :rules="[rules.required]"></v-text-field>
                               <v-text-field v-model="obj.lastname" label="LAST NAME :" outlined dense required
                                                    :rules="[rules.required]"></v-text-field>
                               <v-text-field v-model="obj.emailaddress" label="EMAIL ADDRESS :" outlined dense required
                                                    :rules="[rules.required]"></v-text-field>
                               <v-text-field v-model="obj.contactnumber" label="CONTACT NUMBER :" outlined dense required
                                                    :rules="[rules.required]"></v-text-field>
                                    <v-btn block color="teal"  @click="addInformation()"
                                    :disabled="disabledButton"
                                    style="color:white">
                                        <v-icon>mdi-plus</v-icon>
                                            Add Customer Info.
                                    </v-btn>
                            </v-col>   
                        </div>
                </v-card>
            </v-col>
            <v-col cols="8" >
                <v-card style="height: 92vh;">
                    <v-toolbar color="#4a4a8f" dark style="font-size:17px">
                            DATA INFORMATION
                    </v-toolbar>
                        <div>
                            <v-col cols="5"> 
                                <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line clearable></v-text-field>
                            </v-col> 
                            <v-col>     
                                <v-data-table
                                    :headers="headers"
                                    :items="customerInformation"
                                    class="elevation-2"
                                    :search="search" 
                                    height="60%">
                          
                                <template v-slot:[`item.actions`]="{item}"> 
                                    <v-btn  dense icon @click="editCustomerInformation(item)">
                                        <v-icon  small>mdi-lead-pencil</v-icon>
                                    </v-btn> 
                                    <v-btn dense icon @click="deleteCustomerInfo(item)">
                                        <v-icon  small>mdi-trash-can</v-icon>
                                    </v-btn> 
                                </template>  
                                </v-data-table>
                          <v-dialog v-model="dialog" max-width="500px" persistent>
                               <v-toolbar color="#3b3b58" dark>
                                    <v-icon color="teal" dense>mdi-application-edit</v-icon>
                                        Edit Master Maintenance
                                </v-toolbar>
                                <v-card>
                                    <v-card-text>
                                        <v-container>
                                            <v-row>
                                                <v-col
                                                    cols="12"
                                                   >
                                                    <v-text-field
                                                    v-model="editItem.firstname"
                                                    label="First Name"
                                                    required
                                                    :rules="[rules.required]"
                                                    hide-details
                                                    ></v-text-field>
                                                </v-col> 
                                                <v-col
                                                    cols="12"
                                                   >
                                                    <v-text-field
                                                    v-model="editItem.lastname"
                                                    label="Process Name"
                                                    required
                                                    :rules="[rules.required]"
                                                     hide-details
                                                    ></v-text-field>
                                                </v-col> 
                                                <v-col
                                                    cols="12"
                                                   >
                                                    <v-text-field
                                                    v-model="editItem.emailaddress"
                                                    label="Standard Process Time"
                                                    required
                                                    :rules="[rules.required]"
                                                     hide-details
                                                    ></v-text-field>
                                                </v-col> 
                                                <v-col
                                                    cols="12"
                                                   >
                                                    <v-text-field
                                                    v-model="editItem.contactnumber"
                                                    label="Daily Mistake Limit"
                                                    required
                                                    :rules="[rules.required]"
                                                     hide-details
                                                    ></v-text-field>
                                                </v-col> 
                                               
                                            </v-row>
                                        </v-container>
                                    </v-card-text>
                                    <v-divider></v-divider>
                                    <v-container>
                                        <v-row>
                                            
                                            <v-col cols="6">
                                                <v-btn
                                                    block
                                                     color="teal"
                                                    dark
                                                    @click="closeCategory()">Cancel
                                                </v-btn>
                                            </v-col>
                                            <v-col cols="6">
                                                <v-btn 
                                                    block
                                                    color="deep-orange"
                                                    @click="updateCustomerInformation(editItem)"
                                                    :disabled="disableSave"
                                                    style="color:white">UPDATE
                                                </v-btn>
                                            </v-col>
                                        </v-row>
                                    </v-container>
                                    
                                </v-card>
                            </v-dialog>
                            
                           </v-col>
                           
                       </div>
                      
                </v-card>
                 
            </v-col>
        </v-row>
        
    </div>
</template>

<script>
import Swal from 'sweetalert2' 
import { mapState } from 'vuex'
    export default {
    data: () => ({
    obj : {
            firstname:'',
            lastname:'',
            emailaddress:'',
            contactnumber:'',
    },
      dialog: false,
      dialogDelete: false,
      search : '',
      editItem: '',
      customerInformation : [],
      rules: {
            required: value => !!value || 'Required.'
        },
    
      headers: [
        
        { text: 'First Name', value: 'firstname' },
        { text: 'Last Name', value: 'lastname' },
        { text: 'Email Address', value: 'emailaddress' },
        { text: 'Contact Number', value: 'contactnumber' },
        { text: 'Actions', value: 'actions', sortable: false },
      ],
    }),

created () {
    this.getCustomerInformation()  
},
    computed: {
         ...mapState([
             "userInfo"
         ]),
         disabledButton(){
            if( this.firstname == '' || 
                this.lastname == '' ||
                this.emailaddress == '' ||
                this.contactnumber== ''){
                return true;
            }
         },

        disableSave(){
            if( this.editItem.firstname == '' || 
                this.editItem.lastname == '' ||
                this.editItem.emailaddress == '' ||
                this.editItem.contactnumber== ''){
                return true;
            }
         }

    },
    methods: {
        getCustomerInformation(){
            axios.get('api/getCustomerInformation').then(res =>{
                this.customerInformation = res.data 
            })
        },
 
///ADD  
        addInformation() {
            axios.post('/api/addInformation',{ 
                firstname : this.obj.firstname.toUpperCase(),
                lastname : this.obj.lastname.toUpperCase(),
                emailaddress : this.obj.emailaddress,
                contactnumber : this.obj.contactnumber,
                created_by : this.obj.firstname
            }).then(res => {
                this.getCustomerInformation()
                Swal.fire({ 
                toast: true, 
                position: 'right', 
                icon: 'warning', 
                title: 'warning', 
                background: 'teal',
                text: 'Data successfully Added.!', 
                showConfirmButton: false, 
                timer: 1500})
                this.obj = {};
            }).catch(err => {
                //this.obj = {};
            })
        },
//end

///EDIT  and UPDATE
        editCustomerInformation(item){
            this.editItem = {...item}
            this.dialog = true    
        },
        updateCustomerInformation(editItem){
            const data = {
                id : editItem.id,
                firstname : editItem.firstname.toUpperCase(),
                lastname : editItem.lastname.toUpperCase(),
                emailaddress : editItem.emailaddress,
                contactnumber : editItem.contactnumber, 
            }
            axios.post('/api/updateCustomerInformation', data).then(res =>{
                this.getCustomerInformation()
                this.dialog = false
                Swal.fire({ 
                toast: true, 
                position: 'right', 
                icon: 'warning', 
                title: 'warning', 
                background: '#4a4a8f',
                text: 'Data successfully Updated.!', 
                showConfirmButton: false, 
                timer: 1500})
            });  
        },
///end      

///DELETE        
        deleteCustomerInfo(item){
            const data = { 
                id : item.id,
            }
                Swal.fire({ 
                icon: "question",
                text: "Do you want to delete this data?", 
                showDenyButton: true, 
                showCancelButton: false, 
                confirmButtonColor: '#3085d6', 
                background: '#4a4a8f',
                confirmButtonText: "Delete", 
                denyButtonText: "Cancel"}).then(async (result) => { 
                        if (result.isConfirmed) { 
                            axios.post('/api/deleteCustomerInfo' , data).then(res => {
                                    this.getCustomerInformation()
                                    Swal.fire({ 
                                    toast: true, 
                                    position: 'right', 
                                    icon: 'warning', 
                                    title: 'warning', 
                                    background: '#4a4a8f',
                                    text: 'Data successfully Deleted.!', 
                                    showConfirmButton: false, 
                                    timer: 1500})
                                    })
                        } 
                }) 
        },
///end

        closeCategory(){
            this.dialog = false
        }

    }
  }
</script>

<style  >
.swal2-popup { 
    font-size: 12px !important; 
    font-family: 'Poppins'; 
    color: aliceblue;
    }
</style>