import { Component, useState, useEffect } from 'react'
import { Table, Card, CardBody, CardText, CardTitle, Modal, ModalHeader, ModalBody, ModalFooter, Button, Input, Col, Label, FormGroup, Alert, CardGroup } from 'reactstrap';
import 'bootstrap/dist/css/bootstrap.min.css';

export const PIELES = [
  {
    id: 0,
    imagen: "https://pielparaartesanos.com/cdn/shop/files/Cabra_laminada_oro.jpg",
    nombre: "Cabra laminada oro",
    texto: "Cabra laminada con acabado arrugado en color oro",
    precio: 12
  },
  {
    id: 1,
    imagen: "https://pielparaartesanos.com/cdn/shop/files/Vacuno_encerado_lodo.jpg",
    nombre: "Vacuno encerado lodo",
    texto: "Dale un toque único y resistente a tus productos artesanales con este material de alta calidad",
    precio: 15
  },
  {
    id: 2,
    imagen: "https://pielparaartesanos.com/cdn/shop/files/RST_420.jpg",
    nombre: "Vacuno flor burdeos",
    texto: "La piel vacuno es la opción ideal para los bolsos de calidad",
    precio: 22
  }
];

function Producto(props) {
  return (
    <Card style={{ width: '18rem' }}>
      <img src={props.img} alt={props.nombre} />
      <CardBody>
        <CardTitle tag="h5">{props.nombre}</CardTitle>
        <CardText>{props.texto}</CardText>
        <Button color='primary' onClick={() => props.comprar(props.nombre, props.id)}>Comprar</Button>
      </CardBody>
    </Card>
  )
}

function ShowProductos(props) {
  let Productos = []
  for (let i = 0; i < props.liPro.length; i++) {
    Productos.push(<Producto
      img={props.liPro[i].imagen}
      nombre={props.liPro[i].nombre}
      texto={props.liPro[i].texto}
      comprar={(nombre, id) => props.comprar(nombre, id)}
      id={props.liPro[i].id} />)
  }
  return (
    <CardGroup>
      {Productos.map(p => p)}
    </CardGroup>

  )
}

const VentanaLogin = (props) => {
  const { className } = props;

  const [usuario, setUsuario] = useState();
  const [clave, setClave] = useState();

  const [verAlerta, setVerAlerta] = useState(false)
  const [msgAlerta, setmsgAlerta] = useState()
  const [colorAlerta, setcolorAlerta] = useState()

  const validarDatos = () => {
    if (usuario === undefined || clave === undefined) {
      setVerAlerta(true)
      setcolorAlerta("danger")
      setmsgAlerta('Campos vacios')
    } else {
      props.login(usuario, clave)
      setVerAlerta(true)
      setcolorAlerta("primary")
      setmsgAlerta('Login hecho con exito')
    }
  }

  const handleChange = (event) => {
    let target = event.target;

    if (target.name === "usuario") {
      setUsuario(target.value)
    }

    if (target.name === "clave") {
      setClave(target.value)
    }
  }
  return (
    <Modal isOpen={props.mostrar} toggle={props.toggle} className={className}>
      <ModalHeader toggle={props.toggle}>LOGIN</ModalHeader>
      <ModalBody>
        <FormGroup row>
          <Label sm={2} > Usuario: </Label>
          <Col sm={10}>
            <Input onChange={handleChange}
              id="usuario"
              name="usuario"
              type="Text" />
          </Col>
        </FormGroup>
        <FormGroup row>
          <Label sm={2} > Clave: </Label>
          <Col sm={10}>
            <Input onChange={handleChange}
              id="clave"
              name="clave"
              type="password" />
          </Col>
        </FormGroup>
        <Alert isOpen={verAlerta} color={colorAlerta}>{msgAlerta}</Alert>
      </ModalBody>
      <ModalFooter>
        <Button color='secondary' onClick={() => props.toggle()}>Cerrar</Button>
        <Button color='primary' onClick={() => validarDatos()}>Login</Button>
      </ModalFooter>
    </Modal>
  )
}

const VentanaModal = (props) => {
  const { className } = props;

  const [nombre, setNombre] = useState()
  const [apellido, setApellido] = useState();
  const [direccion, setDireccion] = useState();

  const [verAlerta, setVerAlerta] = useState(false)
  const [msgAlerta, setmsgAlerta] = useState()
  const [colorAlerta, setcolorAlerta] = useState()

  const handleChange = (event) => {
    let target = event.target;

    if (target.name === "nombre") {
      setNombre(target.value)
    }

    if (target.name === "apellido") {
      setApellido(target.value)
    }

    if (target.name === "direccion") {
      setDireccion(target.value)
    }
  }

  useEffect(() => {
    if (!props.mostrar) {
      setVerAlerta(false);
      setmsgAlerta("");
    }
  }, [props.mostrar]);

  const validarDatos = () => {
    if (nombre === undefined || apellido === undefined || direccion === undefined) {
      setVerAlerta(true)
      setcolorAlerta("danger")
      setmsgAlerta('Campos vacios o erroneos')
    } else if (props.carro.length < 1) {
      setVerAlerta(true)
      setcolorAlerta("warning")
      setmsgAlerta('Carrito vacio!!')
    } else {
      props.pedir()
      setVerAlerta(true)
      setcolorAlerta("primary")
      setmsgAlerta('Pedido hecho con exito')
    }

  }
  return (
    <div>
      <Modal isOpen={props.mostrar} toggle={props.toggle} className={className}>
        <ModalHeader toggle={props.toggle}>CARRITO DE LA COMPRA</ModalHeader>
        <ModalBody>
          {props.carro.map(p => {
            return (<p>{p.nombre + " - " + p.cantidad + " - " + p.precio + "€"}
              {"  "}
              {<Button onClick={() => props.resta(p.id, p.precio)}>-</Button>}
              {<Button onClick={() => props.suma(p.id, p.precio)}>+</Button>}</p>)
          })}
          {"Total: " + props.totalPrecio() + "€"}
          <FormGroup row>
            <Label sm={2} > Nombre: </Label>
            <Col sm={10}>
              <Input onChange={handleChange}
                id="nombre"
                name="nombre"
                type="Text" />
            </Col>
          </FormGroup>
          <FormGroup row>
            <Label sm={2} > Apellido: </Label>
            <Col sm={10}>
              <Input onChange={handleChange}
                id="apellido"
                name="apellido"
                type="text" />
            </Col>
          </FormGroup>
          <FormGroup row>
            <Label sm={2} > Dirección: </Label>
            <Col sm={10}>
              <Input onChange={handleChange}
                id="direccion"
                name="direccion"
                type="text" />
            </Col>
          </FormGroup>
          <Alert isOpen={verAlerta} color={colorAlerta}>{msgAlerta}</Alert>
        </ModalBody>
        <ModalFooter>
          <Button color='primary' onClick={() => validarDatos()}>PEDIR</Button>
          <Button color='primary' onClick={() => props.toggle()}>CERRAR</Button>
        </ModalFooter>
      </Modal>
    </div>
  )
}

const VentanaModalPedidos = (props) => {
  const { className } = props;

  return (
    <Modal isOpen={props.mostrar} toggle={props.toggle} className={className}>
      <ModalHeader toggle={props.toggle}>HISTORIAL DE PEDIDOS</ModalHeader>
      <ModalBody>
        {props.pedidos.map((pe, index) => (
          <div key={index}>
            <h3>Pedido: {pe.id}</h3>
            <Table hover responsive>
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Nombre</th>
                  <th>Cantidad</th>
                  <th>Precio</th>
                </tr>
              </thead>
              <tbody>
                {pe.productos.map((pro, index) => (
                  <tr key={index}>
                    <th>{pro.id}</th>
                    <td>{pro.nombre}</td>
                    <td>{pro.cantidad}</td>
                    <td>{pro.precio}</td>
                  </tr>
                ))}
              </tbody>
            </Table>
            <Table bordered>
              <tbody>
                <tr>
                  <th>Total</th>
                  <td>{pe.precioTotal}€</td>
                </tr>
              </tbody>
            </Table>
            <hr />
          </div>
        ))}
      </ModalBody>
      <ModalFooter>
        <Button color="secondary" onClick={props.toggle}>Cerrar</Button>
      </ModalFooter>
    </Modal>
  );
}

class App extends Component {
  constructor(props) {
    super(props);

    this.state = {
      listaProductos: PIELES,
      carrito: [],
      pedidos: [],
      usuarios: [{ usuario: "admin1", clave: "123456", tipo: "admin" }, { usuario: "normal1", clave: "123456", tipo: "normal" }],
      logueado: true,

    };
  }

  toggleModal() {
    this.setState({ isOpen: !this.state.isOpen })
  }

  toggleModal2() {
    this.setState({ isOpen2: !this.state.isOpen2 })
  }

  toggleModal3() {
    this.setState({ isOpen3: !this.state.isOpen3 })
  }

  login(usuario, clave) {
    let auxLog = this.state.logueado

    auxLog = true

    this.state.usuarios.map(u => {
      if (u.usuario === usuario && u.clave === clave && u.tipo === "admin") {
        auxLog = false
      }
    })

    this.setState({ logueado: auxLog })
  }

  pedir() {
    let auxPedidos = this.state.pedidos
    let auxCarrito = this.state.carrito
    let idPedido = auxPedidos.length ? auxPedidos[auxPedidos.length - 1].id + 1 : 1;
    let productosPedido = []

    auxCarrito.map(p => {
      if (p.cantidad > 0) {
        productosPedido.push(p)
      }
    })

    auxPedidos.push({ id: idPedido, productos: productosPedido, precioTotal: this.totalPrecio() })

    this.setState({ pedidos: auxPedidos })

    console.log(this.state.pedidos)

    this.vaciarCarrito()
  }

  Comprar(nombre, id) {
    let auxCarrito = this.state.carrito;
    let precio = this.state.listaProductos.find(p => p.id === id).precio
    let img = this.state.listaProductos.find(p => p.id === id).imagen

    let existe = auxCarrito.filter(p => p.id === id).length
    if (existe === 0) {
      let producto = { id: id, nombre: nombre, cantidad: 1, precio: precio, imagen: img }
      auxCarrito.push(producto)
    } else {
      auxCarrito.map(p => {
        if (p.id === id) {
          p.cantidad += 1
          p.precio += precio
        }
      })
    }

    this.setState({ carrito: auxCarrito })
  }

  suma(id) {
    let auxCarrito = this.state.carrito;
    let precio = this.state.listaProductos.find(p => p.id === id).precio

    auxCarrito.map(p => {
      if (p.id === id) {
        p.cantidad += 1
        p.precio += precio
      }
    })

    this.setState({ carrito: auxCarrito })
  }

  resta(id) {
    let auxCarrito = this.state.carrito;
    let precio = this.state.listaProductos.find(p => p.id === id).precio

    auxCarrito = auxCarrito.map(p => {
      if (p.id === id) {
        if (p.cantidad > 0) {
          p.cantidad -= 1;
          p.precio -= precio
        }
        if (p.cantidad === 0) {
          return null;
        }
      }
      return p;
    }).filter(p => p !== null);

    this.setState({ carrito: auxCarrito });
  }

  totalEnCarrito() {
    let total = 0;

    this.state.carrito.map(p => {
      total += p.cantidad
    })

    return (total)
  }

  totalPrecio() {
    let total = 0;

    this.state.carrito.map(p => {
      total += p.precio
    })

    return (total)
  }

  vaciarCarrito() {
    this.setState({ carrito: [] });
  }


  render() {
    return (
      <>
        <Button color='primary' onClick={() => this.toggleModal()}>Carrito({this.totalEnCarrito()})</Button>
        <Button hidden={this.state.logueado} color='primary' onClick={() => this.toggleModal2()}>Pedidos</Button>
        <Button color='primary' onClick={() => this.toggleModal3()}>Login</Button>

        <ShowProductos liPro={this.state.listaProductos} comprar={(nombre, id) => this.Comprar(nombre, id)} />

        <VentanaModal
          mostrar={this.state.isOpen}
          toggle={() => this.toggleModal()}
          carro={this.state.carrito}
          resta={(id) => this.resta(id)}
          suma={(id) => this.suma(id)}
          totalPrecio={() => this.totalPrecio()}
          pedir={() => this.pedir()}
        />

        <VentanaModalPedidos
          mostrar={this.state.isOpen2}
          toggle={() => this.toggleModal2()}
          pedidos={this.state.pedidos}
        />

        <VentanaLogin
          mostrar={this.state.isOpen3}
          toggle={() => this.toggleModal3()}
          login={(usuario, clave) => this.login(usuario, clave)}
        />
      </>
    );
  }
}
export default App;