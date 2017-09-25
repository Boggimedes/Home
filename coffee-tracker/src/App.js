import React, {Component} from 'react';
import { BrowserRouter } from 'react-router-dom';
import Master from './components/Master';

class App extends Component {
  render(){
    return (
		<BrowserRouter>
			<Master />
		</BrowserRouter>    
    )
  }
}

export default App;

