// CreateItem.js

import React, {Component} from 'react';
import { createHashHistory } from 'history';
import axios from 'axios';

class Profile extends Component {

  componentWillMount(){
    console.log(this.props.match.params.id);
    this.state = {
      fullname: '',
      username:''
    };
  }//Need to pass the ID into a subscription element as well as the data parameters
componentDidMount(){
      axios.get(`/api/user/${this.props.match.params.id}`)
    .then(response => {
      console.log(response);
      this.setState({ fullname: response.data.fullname, username: response.data.username});
    })
    .catch(function (error) {
      console.log(error);
    })

}
  handleChange(e) {
    console.log(this);
    this.setState({
      fullname: e.target.value
    })
  };

  handleSubmit(){
    const user = {
      id: this.props.match.params.id,
      fullname: this.state.fullname
    }
    let uri = '/api/user/' + this.props.match.params.id;
    axios.put(uri, user)      
        .then(response => {
          console.log(response);
          this.setState({ fullname: response.data.fullname, username: response.data.username});
        })
        .catch(error => {
          console.log(error);
        });
  };


    render() {
      return (
      <div>
        <h1>Fill Out Your Name</h1>
          <div className="row">
            <div className="col-md-6">
              <div className="form-group">
                <label>Username:</label>
                <input type="text" name="username" className="form-control" value={this.state.username} disabled/>
              </div>
            </div>
            </div>
            <div className="row">
              <div className="col-md-6">
                <div className="form-group">
                  <label>Full Name:</label>
                  <input type="text" name="fullname" className="form-control col-md-6" value={this.state.fullname} onChange={(e) => this.handleChange(e)}/>
                </div>
              </div>
            </div><br />
            <div className="form-group">
              <button type="button" onClick={() => this.handleSubmit()} className="btn btn-primary">Save</button>
            </div>
  </div>
      )
    }
}
export default Profile;