
// Home.js

import React, {Component} from 'react';
import { Redirect } from 'react-router-dom';

class Home extends Component {

	componentWillMount() {
		this.state = {
			username: ''
		}
	}

  handleChange(e) {
    console.log(this);
    this.setState({
      username: e.target.value
    })
  };

  handleSubmit(){
    const user = {
      username: this.state.username
    }
    let uri = '/api/user';
    axios.post(uri, user)      
        .then(response => {
          console.log(Redirect);
          this.props.history.push(`/coffee-tracker/${response.data.id}/profile`);
          this.setState({ username: response.data.username, id: response.data.id });
        })
        .catch(error => {
          console.log(error);
        });
  };

  render(){
    return (
        <div className="col-sm-8 col-sm-offset-2">
        <h1>Enter your username</h1>
		<div className="col-md-6 col-md-offset-2">
		  <div className="input-group">
		    <input className="form-control" placeholder="Username" type="text"  value={this.state.username} onChange={(e) => this.handleChange(e)}/>
		    <span className="input-group-btn">
		      <button type="button" onClick={() => this.props.handleUsername(this.state.username)} className="btn btn-primary">Go</button>
		    </span>
		  </div>
		</div>
		</div>
    )
  }
}
export default Home;