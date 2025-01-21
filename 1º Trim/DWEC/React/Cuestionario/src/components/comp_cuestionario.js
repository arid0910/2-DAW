import { Row, Col, Card, CardTitle, CardText, Button, CardSubtitle } from 'reactstrap';

export default function Cuestionario(props) {
  return (
    <Row>
      {props.listaPre.map((item) => (
        <Col sm="11">
          <Card body>
            <CardTitle tag="h5">Cuestionario de Adicción al Móvil</CardTitle>
            <CardSubtitle>Pregunta {item.id}</CardSubtitle>
            <CardText>{item.pregunta}</CardText>
            <Row sm="6">
              <Col sm="1">
                <Button color="primary" onClick={()=>props.click("Si", item.id)}>Sí</Button>
              </Col>
              <Col>
                <Button color="secondary" onClick={()=>props.click("No", item.id)}>No</Button>
              </Col>
            </Row>
          </Card>
        </Col>
      ))}
    </Row>
  );
}
