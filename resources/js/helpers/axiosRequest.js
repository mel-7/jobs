class AxiosRequest {
    // constructor(errors = {}) {
    //   this.setErrors(errors);
    // }
    getData(route, id){
        // let data = [{
        //     'meh' : 1,
        //     'meh2' : 2
        // }];
        // let obj = [];
        // let status = '';
        // let res = {};
        // var data = 'sd';

        // setTimeout(() => {
        axios.get(route + id)
            .then(response => {
                // data = JSON.stringify(response.data);
                // data['status'] = 'success';
                // obj['data'] = response.data.data;
                // obj['status'] = 'success';
                // obj['data'] = JSON.stringify(response.data);

                // res.status = 'success';
                // return response.data;
                // return res = {
                //     'data' : response.data,
                //     'status' : 'success'
                // };
                // console.log('success');
                // return {
                //     data
                // };
                // console.log(data);
                return {
                    'o' : response.data,
                    'status' : success
                    // 'status' : 'success'
                };
                // return data;
            })
            .catch(error => {
                // console.log('error');
                // res.data = {};
                // res.status = 'error';
                // return res;
            });

        // }, 100);
        // console.log(data);
        // return {
        //     'o' : data
        //     // 'status' : 'success'
        // };
        // return {
        //     'data' :  data,
        //     'status' : 'success'
        // }
        // return Object.keys(data);
        // return JSON.stringify(obj['data']);
        // return {
        //     obj
        // };
        // return {
        //     'obj' : obj,
        //     'status': status
        // }
    }

    postData(){
        console.log('Post data');
    }

    deleteData(){
        console.log('Delete Data');

    }

  }
export default AxiosRequest;
