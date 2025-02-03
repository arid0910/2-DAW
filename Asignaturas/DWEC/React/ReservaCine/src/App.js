import React, { Component, useState } from 'react';
import { Row, FormGroup, Button, Label, Input } from 'reactstrap';
import 'bootstrap/dist/css/bootstrap.min.css';

function Cliente(props) {
  const handleOnChange = (event) => {
    
  }

  const clicar = () => {

  }

  return (
    <Row>
      <FormGroup>
        <Label for="nombre">Nombre</Label>
        <Input id='nombre' name='nombre' placeholder='nombre de cliente' type='text' onChange={handleOnChange} />
      </FormGroup>
      <Button color='primary' onClick={clicar}><storng>Reservar</storng></Button>
    </Row>
  )
}

function Botonera(props){
  let tabla = []
  for (let i = 0; i < 9; i++) {
    let fila = []
    for (let j = 0; j < 9; j++) {
      fila.push(<Button onClick={props.click(i, j)}>{props.liBtn[i][j]}</Button>)
    }
    tabla.push(<br/>)
    tabla.push(fila)
  }

  console.log(tabla)
  return(
    tabla
  )
}

class App extends Component{
  constructor (props){
    super(props);

    this.state = {
      listaBotones: JSON.parse(JSON.stringify((Array(9).fill(Array(9).fill({reservado: false, seleccionado: false, fulano: ""})))))

    };
  }

  clicar(i,j){
    
  }

  reservar(nombre){

  }

  render(){
    return(
      <div className='App'>
        <Botonera  click = {(i,j) => this.clicar(i,j)} liBtn = {this.state.listaBotones}/>
        <Cliente />
      </div>
    );
  }
}

export default App;