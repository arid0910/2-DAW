import React, { Component, useState } from 'react'
import { Button, Table, Input, Modal, ModalHeader, ModalBody, ModalFooter, FormGroup, Label, Col, Alert } from 'reactstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Tab } from 'bootstrap';

const Corredor = (props) => {
  const { className } = props;

  const [nombre, setNombre] = useState("")
  const [equipo, setequipo] = useState("")

  const [alerta, setAlerta] = useState(false)
  const [msgalerta, setMsgAlerta] = useState("")
  const [Colalerta, setColAlerta] = useState("")

  const handlerChange = (event) => {
    let target = event.target

    if (target.name === "nombre") {
      setNombre(target.value)
    }

    if (target.name === "equipo") {
      setequipo(target.value)
    }

    console.log(nombre)
  }

  const validarDatos = () => {
    let repetido = props.liCorredores.find(c => c.nombre === nombre)

    if (nombre === "" || equipo === "") {
      setAlerta(true)
      setMsgAlerta("Campos Vacios")
      setColAlerta("danger")
    } else if (repetido !== undefined) {
      setAlerta(true)
      setMsgAlerta("Corredor ya dado de alta")
      setColAlerta("warning")
    } else {
      props.alta(nombre, equipo)
    }
  }

  return (
    <div>
      <Modal isOpen={props.mostrar} toggle={props.toggle} className={className} onEntering={() => { }}>
        <ModalHeader toggle={props.toggle}>AÑADIR CORREDOR</ModalHeader>
        <ModalBody>
          <FormGroup row>
            <Label sm={2}>Nombre: </Label>
            <Col sm={10}>
              <Input
                onChange={handlerChange}
                id='nombre'
                name='nombre'
                type='text'
              />
            </Col>
          </FormGroup>
          <FormGroup row>
            <Label sm={2}>Equipo: </Label>
            <Col sm={10}>
              <Input
                onChange={handlerChange}
                id='equipo'
                name='equipo'
                type='text'
              />
            </Col>
          </FormGroup>
          <Alert isOpen={alerta} color={Colalerta}>{msgalerta}</Alert>
        </ModalBody>
        <ModalFooter>
          <Button color='primary' onClick={() => validarDatos()}>AÑADIR CORREDOR</Button>
        </ModalFooter>
      </Modal>
    </div>
  );
}

const Mostrar = (props) => {
  let aux = []
  let ultimo = props.liCorredores.length

  for (let i = 0; i < props.liCorredores.length; i++) {
    let boton = ""
    let id = props.liCorredores[i].posicion;

    if (props.liCorredores[i].posicion === 1) {
      boton = <Button onClick={() => props.down(id)}>DOWN</Button>;
    } else if (props.liCorredores[i].posicion === ultimo) {
      boton = <Button onClick={() => props.up(props.liCorredores[i].posicion)}>UP</Button>;
    } else {
      boton =
        <>
          <Button onClick={() => props.up(props.liCorredores[i].posicion)}>UP</Button>
          <Button onClick={() => props.down(props.liCorredores[i].posicion)}>DOWN</Button>
        </>;
    }

    aux.push(<tr>
      <th scope='row'>{props.liCorredores[i].posicion}</th>
      <td>{props.liCorredores[i].nombre}</td>
      <td>{props.liCorredores[i].equipo}</td>
      <td>{boton}</td>
    </tr>)

  }
  return (
    <>
      <Table>
        <thead>
          <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Equipo</th>
            <th>Posición</th>
          </tr>
        </thead>
        <tbody>
          {aux.map(c => c)}
        </tbody>
      </Table>
    </>
  );
}
class App extends Component {
  constructor(props) {
    super(props);

    this.state = {
      listaCorredores: [{ nombre: "Eleuterio Casas", equipo: "Rambito Team", posicion: 1 },
      { nombre: "Francis NGanou", equipo: "Rambito Team", posicion: 2 },
      { nombre: "Emilio Anaya", equipo: "Istan Team", posicion: 3 },
      ],
      isOpen: false
    }
  }

  toggleModal() {
    this.setState({ isOpen: !this.state.isOpen })
  }

  altaCorredor(nombre, equipo) {
    let aux = this.state.listaCorredores

    let ultimo = aux.length + 1

    aux.push({ nombre: nombre, equipo: equipo, posicion: ultimo })

    this.setState({ listaCorredores: aux })
  }

  down(id) {
    let auxLi = this.state.listaCorredores
    let tamaño = auxLi.length
    for (let i = 0; i < tamaño; i++) {
      if (auxLi[i].posicion === id && i < auxLi.length - 1) {
        let auxNom = auxLi[i].nombre;
        let auxEqui = auxLi[i].equipo;

        auxLi[i].nombre = auxLi[i + 1].nombre;
        auxLi[i].equipo = auxLi[i + 1].equipo;

        auxLi[i + 1].nombre = auxNom;
        auxLi[i + 1].equipo = auxEqui;
      }

    }

    this.setState({ listaCorredores: auxLi })
  }

  up(id) {
    let auxLi = this.state.listaCorredores
    let tamaño = auxLi.length
    for (let i = 0; i < tamaño; i++) {
      if (auxLi[i].posicion === id && i <= auxLi.length -1) {
        let auxNom = auxLi[i].nombre;
        let auxEqui = auxLi[i].equipo;

        auxLi[i].nombre = auxLi[i - 1].nombre;
        auxLi[i].equipo = auxLi[i - 1].equipo;

        auxLi[i - 1].nombre = auxNom;
        auxLi[i - 1].equipo = auxEqui;
      }
    }

    this.setState({ listaCorredores: auxLi })
  }

  render() {
    return (
      <div className="App">
        <h1>CARRERAS DE ORIENTACIÓN DE ISTAN</h1>
        <Mostrar
          liCorredores={this.state.listaCorredores}
          up={(id) => this.up(id)}
          down={(id) => this.down(id)}
        />
        <Button onClick={() => this.toggleModal()} color='info'>ALTA CORREDOR</Button>
        <Corredor
          mostrar={this.state.isOpen}
          toggle={() => this.toggleModal()}
          liCorredores={this.state.listaCorredores}
          alta={(nombre, equipo) => this.altaCorredor(nombre, equipo)}
        />
      </div>
    );
  }
}
export default App;