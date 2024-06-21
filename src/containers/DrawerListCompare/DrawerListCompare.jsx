import { Drawer } from 'antd';
const DrawerListCompare = ({ open, onClose }) => {
  return (
    <Drawer
      title="Drawer with extra actions"
      placement={'right'}
      width={200}
      onClose={onClose}
      open={open}
    >
      <p>Some contents...</p>
      <p>Some contents...</p>
      <p>Some contents...</p>
    </Drawer>
  );
};
export default DrawerListCompare;
