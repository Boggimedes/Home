import React, {Component} from 'react';
import { Button } from 'react-bootstrap';
import TableRow from './TableRow';

class Coffees extends Component {
  state = {
    drinkName: null,
    userId: null
  };
  componentWillMount() {
    this.props.checkUser(this.props.match.params.username);
    if(this.props.match.params.username === '')
      this.props.history.push(`/coffee-tracker`);
  }
  handleKeyPress = e => {
    if (e.key === 'Enter') {
      this.props.addDrink(this.state.drinkName);
      this.setState({
        drinkName: ''
      })
    }
  };

  handleSubmit = () => {
    this.props.addDrink(this.state.drinkName)
    this.setState({
      drinkName: ''
    })
  }

  handleChange = e => {
    this.setState({
      drinkName: e.target.value
    })
  }
  tabRow = () => {
    if(this.props.user.drinks instanceof Array){
      return this.props.user.drinks.map((object, i) => {
        return <TableRow obj={object} key={i} handleDelete={() => this.props.handleDelete(object.id)} />;
      },this)
    }
  }

  render(){
    return (
      <div>
        <h1>{this.props.user.fullname ? this.props.user.fullname+'\'s':''} Drinks</h1>
        <div className="row">
          <div className="col-md-5">
            <input className="form-control"  type="text"  value={this.state.drinkName} onKeyPress={(e) => this.handleKeyPress(e)} onChange={(e) => this.handleChange(e)} placeholder="Enter Drink Name (eg Mocha, Coffee, Tea, Chai, etc)" />
          </div>
          <div className="col-md-2">
            <Button onClick={this.handleSubmit} bsStyle="primary">Add Drink</Button>
          </div>
        </div><br />
        <table className="table table-hover">
            <thead>
            <tr>
                <td>Item Name</td>
                <td>Timestamp</td>
            </tr>
            </thead>
            <tbody>
              {this.tabRow()}
            </tbody>
        </table>
    </div>
    )
  }
}
export default Coffees;