import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Button } from 'reactstrap';
import { Component } from 'react'
import AppLogin from './Componentes/AppLogin';
import Menu from './Componentes/Menu'

class App extends Component {
  constructor(props) {
    super(props);

    this.state = {
      menuItem: "UNO",
      logged: false,
    }
  }

  changeMenu(item) {
    this.setState({
      menuItem: item
    })
  }
  
  render() {
    let obj = <Menu changeMenu={(item) => this.changeMenu(item)} />

    if (!this.state.logged) {
      obj = <AppLogin userLogin={(this.state.menuItem)} changeMenu={(item) => this.changeMenu(item)} />
    }

    return (
      <div className="App">
        <Menu menuItem={this.state.menuItem} changeMenu={(item) => this.changeMenu(item)} />
        {obj}
      </div>
    );
  }
}
export default App;