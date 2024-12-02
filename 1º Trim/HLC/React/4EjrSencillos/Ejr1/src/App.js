import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Alert, Button } from 'reactstrap';
import { Component } from 'react'

class App extends Component {
  constructor(props){
    super(props)

    this.state={
     
    }
  }

  alertaRojo(){
    <Alert>Hola</Alert>
  }

  render(){
    return (
      <div className="App">
        <Button color='primary' onClick={()=>this.alerta()}>Click Me</Button>
        <Button color='danger' onClick={()=>this.alerta()}>Click Me</Button>
      </div>
    );
  }
}
export default App;