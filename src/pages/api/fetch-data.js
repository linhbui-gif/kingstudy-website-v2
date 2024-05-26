import { ETypeNotification } from '@/common/enums';
import ApiService from '@/services';
import { showNotification } from '@/utils/function';

export const config = {
  api: {
    bodyParser: true,
  },
};
export default async function handler(req, res) {
  try {
    const { params } = req.body.body;
    const response = await ApiService.get(`/school/filter-school`, {
      params: params,
    });
    const data = response.data;
    if (data?.code === 200) {
      res.status(200).json({ data });
    } else {
      showNotification(ETypeNotification.ERROR, data?.message);
    }
  } catch (error) {
    if (error.response) {
      res
        .status(error.response.status)
        .json({ error: error.response.statusText });
    } else if (error.request) {
      res.status(500).json({ error: 'No response received from external API' });
    } else {
      res.status(500).json({ error: 'An error occurred' });
    }
  }
  res.end();
}
