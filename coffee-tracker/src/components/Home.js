import React, {Component} from 'react';
import { Button } from 'react-bootstrap';

class Home extends Component {
	componentWillMount() {
		this.state = {
			username: ''
		}
	}
  handleKeyPress = e => {
    if (e.key === 'Enter') {
      this.props.handleUsername(this.state.username);
    }
  };
  handleChange = e => {
    this.setState({
      username: e.target.value
    })
  };

  render(){
    return (
      <div className="col-sm-8 col-sm-offset-2">
        <h1>Enter your username</h1>
        <div className="col-md-6 col-md-offset-2">
          <div className="input-group">
            <input className="form-control" placeholder="Username" type="text"  value={this.state.username} onKeyPress={(e) => this.handleKeyPress(e)} onChange={(e) => this.handleChange(e)}/>
            <span className="input-group-btn">
              <Button onClick={() => this.props.handleUsername(this.state.username)} bsStyle="primary">Go</Button>
            </span>
          </div>
        </div>
      </div>
    )
  }
}
export default Home;