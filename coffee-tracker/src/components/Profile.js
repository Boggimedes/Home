import React, {Component} from 'react';
import { Button } from 'react-bootstrap';

class Profile extends Component {
  state = {
    fullname: ''
  };

  componentWillMount() {
    this.props.checkUser(this.props.match.params.username);
    if(this.props.match.params.username === '')
      this.props.history.push(`/coffee-tracker`);
  }
  componentDidMount(){
    this.setState({ fullname: this.props.user.fullname});
  }
  handleKeyPress = e => {
    if (e.key === 'Enter') {
      this.props.handleFullname(this.state.fullname);
    }
  };

  handleChange(e) {
    this.setState({
      fullname: e.target.value
    })
  };
    render() {
      return (
        <div>
          <h1>Fill Out Your Name</h1>
          <div className="row">
            <div className="col-md-6">
              <div className="form-group">
                <label>Username:</label>
                <input type="text" name="username" className="form-control" value={this.props.user.username} disabled/>
              </div>
            </div>
          </div>
          <div className="row">
            <div className="col-md-6">
              <div className="form-group">
                <label>Full Name:</label>
                <input type="text" name="fullname" 
                  className="form-control col-md-6" 
                  value={this.state.fullname? this.state.fullname:this.props.user.fullname} 
                  onChange={(e) => this.handleChange(e)}
                  onKeyPress={(e) => this.handleKeyPress(e)}
                  />
              </div>
            </div>
          </div><br />
          <div className="form-group">
            <Button onClick={() => this.props.handleFullname(this.state.fullname)} bsStyle="primary">Save</Button>
          </div>
        </div>
      )
    }
}
export default Profile